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
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $loans = $this->paginate($this->Loans, ['contain' => ['Files', 'Users']]);

        $this->set(compact('loans'));
        $this->set('_serialize', ['loan']);
    }

    /**
     * View method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loan = $this->Loans->get($id, [
            'contain' => ['Users', 'Books', 'Files', 'Subcategories']
        ]);
        
        $this->set('loan', $loan);
        $this->set('_serialize', ['loan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
       public function add() {
        $loan = $this->Loans->newEntity();
        if ($this->request->is('post')) {
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            // Ajout de cette ligne
            $loan->user_id = $this->Auth->user('id');
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The loan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loan could not be saved. Please, try again.'));
        }
        $files = $this->Loans->Files->find('list', ['limit' => 200]);

        // Bâtir la liste des catégories  
        $this->loadModel('Categories');
        $categories = $this->Categories->find('list', ['limit' => 200]);

        // Extraire le id de la première catégorie
        $categories = $categories->toArray();
        reset($categories);
        $category_id = key($categories);

        // Bâtir la liste des sous-catégories reliées à cette catégorie
        $subcategories = $this->Loans->Subcategories->find('list', [
            'conditions' => ['Subcategories.category_id' => $category_id],
        ]);

        $this->set(compact('loan', 'subcategories', 'categories', 'files'));
        $this->set('_serialize', ['loan', 'subcategories', 'categories', 'files']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */ 
    public function edit($id = null) {
        $loan = $this->Loans->get($id, [
            'contain' => ['Files', 'Subcategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            // Ajout de cette ligne
            $loan->user_id = $this->Auth->user('id');
            if ($this->Loans->save($loan)) {
                $this->Flash->success(__('The loan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The loan could not be saved. Please, try again.'));
        }
        $files = $this->Loans->Files->find('list', ['limit' => 200]);
        $this->set(compact('loan', 'files'));
        $this->set('_serialize', ['loan']);
    }
    public function editLast($id = null) {
        $loans =  $this->Loans->find('all')->all();
        $lastLoan = $loans->last();
        return $this->redirect(['action' => 'edit', $lastLoan->id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $loan = $this->Loans->get($id);
        if ($this->Loans->delete($loan)) {
            $this->Flash->success(__('The loan has been deleted.'));
        } else {
            $this->Flash->error(__('The loan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
   

    public function isAuthorized($user) {
        // All registered users can add loans
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        // The owner of an loan can edit and delete it
        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            $loanId = (int) $this->request->getParam('pass.0');
            if ($this->Loans->isOwnedBy($loanId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}
