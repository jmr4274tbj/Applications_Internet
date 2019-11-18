<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Loans Controller
 *
 * @property \App\Model\Table\LoansTable $Loans
 *
 * @method \App\Model\Entity\Loan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoansController extends AppController
{
    public function initialize() {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['tags']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $loans = $this->paginate($this->Loans);

        $this->set(compact('loans'));
    }

    /**
     * View method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $loan = $this->Loans
                ->findBySlug($slug)
                ->contain('Tags') // load associated Tags
                ->contain('Books')
                ->contain('Users')
                ->contain('Files')
                ->firstOrFail();
        $this->set('loan', $loan);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {        
        $loan = $this->Loans->newEntity();
        if ($this->request->is('post')) {
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());

            // Changed: Set the user_id from the session.
            $loan->user_id = $this->Auth->user('id');
            //debug($loan); die();
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The loan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loan could not be saved. Please, try again.'));
        }
        $users = $this->Loans->Users->find('list', ['limit' => 200]);
        $tags = $this->Loans->Tags->find('list', ['limit' => 200]);
        $this->set(compact('loan', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $loan = $this->Loans
                ->findBySlug($slug)
                ->contain('Tags') // load associated Tags
                ->firstOrFail();
        /* $loan = $this->Loans->get($id, [
          'contain' => ['Tags']
          ]); */
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loan = $this->Loans->patchEntity($loan, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The loan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loan could not be saved. Please, try again.'));
        }
        $users = $this->Loans->Users->find('list', ['limit' => 200]);
        $tags = $this->Loans->Tags->find('list', ['limit' => 200]);
        $this->set(compact('loan', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $loan = $this->Loans->findBySlug($slug)->firstOrFail();
        if ($this->Loans->delete($loan)) {
            $this->Flash->success(__('The loan has been deleted.'));
        } else {
            $this->Flash->error(__('The loan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function tags(...$tags) {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        // $tags = $this->request->getParam('pass');
        // Use the LoansTable to find tagged loans.
        $loans = $this->Loans->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'loans' => $loans,
            'tags' => $tags
        ]);
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the loan belongs to the current user.
        $loan = $this->Loans->findBySlug($slug)->first();

        return $loan->user_id === $user['id'];
    }
}
