<?php
namespace App\Controller;

class RecipesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $recipes = $this->Paginator->paginate($this->Recipes->find()->contain(['Ingredients']));
        $this->set(compact('recipes'));
    }

    public function view($id = null)
    {
        $recipe = $this->Recipes->findById($id)->firstOrFail();
        $this->set(compact('recipe'));
    }

    public function add()
    {
        $recipe = $this->Recipes->newEntity($this->request->getData(),[
            'associated' => 'Ingredients'
        ]);
        if ($this->request->is('post')) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData() ,[
                'associated' => 'Ingredients'
            ]);
            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your recipe.'));
        }
        $this->set('recipe', $recipe);
    }

    public function edit($id)
    {
        $recipe = $this->Recipes->findById($id)->contain(['Ingredients'])->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Recipes->patchEntity($recipe, $this->request->getData());
            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your recipe.'));
        }

        $this->set('recipe', $recipe);
    }


    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $recipe = $this->Recipes->findById($id)->firstOrFail();
        if ($this->Recipes->delete($recipe)) {
            $this->Flash->success(__('The {0} article has been deleted.', $recipe->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}