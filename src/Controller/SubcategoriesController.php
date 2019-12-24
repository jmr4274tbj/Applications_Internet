<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subcategories Controller
 *
 * @property \App\Model\Table\SubcategoriesTable $Subcategories
 *
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubcategoriesController extends AppController
{

    public function getByCategory() {
        $category_id = $this->request->query('category_id');

        $subcategories = $this->Subcategories->find('all', [
            'conditions' => ['Subcategories.category_id' => $category_id],
        ]);
        $this->set('subcategories',$subcategories);
        $this->set('_serialize', ['subcategories']);
    }
    
    public function getSubcategoriesSortedByCategories() {
        $categories = $this->Subcategories->Categories->find('all', [
            'contain' => ['Subcategories'],
        ]);
        $this->set('categories',$categories);
        $this->set('_serialize', ['categories']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
        public function index() {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $subcategories = $this->paginate($this->Subcategories);

        $this->set(compact('subcategories'));
        $this->set('_serialize', ['subcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $data = $this->request->input('json_decode');
        //debug($data); die();
        $id = $data->id;
        $subcategory = $this->Subcategories->get($id, [
            'contain' => ['Categories', 'Loans']
        ]);

        $this->set('subcategory', $subcategory);
        $this->set('_serialize', ['subcategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $subcategory = $this->Subcategories->newEntity();
        if ($this->request->is('post')) {
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategories->save($subcategory)) {
                //$this->Flash->success(__('The subcategory has been saved.'));
                //return $this->redirect(['action' => 'index']);
                $response = ['result' => 'Subcategory was created.'];
            } else {
                //$this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
                $response['error'] = __('The subcategory could not be saved. Please, try again.');
            }
        }
        //$categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        //$this->set(compact('subcategory', 'categories'));
        //$this->set('_serialize', ['subcategory']);
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $data = $this->request->input('json_decode');
        //debug($data); die();
        $id = $data->id;
        $subcategory = $this->Subcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategories->save($subcategory)) {
                //$this->Flash->success(__('The subcategory has been saved.'));
                //return $this->redirect(['action' => 'index']);
                $response = ['result' => 'Subcategory was updated.'];
            } else {
                //$this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
                $response['error'] = __('The subcategory could not be saved. Please, try again.');
            }
        }
        //$categories = $this->Subcategories->Categories->find('list', ['limit' => 200]);
        //$this->set(compact('subcategory', 'categories'));
        //$this->set('_serialize', ['subcategory']);
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $data = $this->request->input('json_decode');
        //debug($data); die();
        $id = $data->id;
        $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->Subcategories->get($id);
        if ($this->Subcategories->delete($subcategory)) {
            //$this->Flash->success(__('The subcategory has been deleted.'));
            $response = ['result' => 'Subcategory was deleted.'];
        } else {
            //$this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
            $response = ['error' => 'The Subcategory could not be deleted. Please, try again.'];
        }

        //return $this->redirect(['action' => 'index']);
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }
}
