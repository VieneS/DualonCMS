<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 */
class RolesController extends AppController
{

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Role->recursive = 0;
        $this->set('roles', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $this->set('role', $this->Role->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }
        }
        $parentRoles = $this->Role->ParentRole->find('list');
        $this->set(compact('parentRoles'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Role->read(null, $id);
        }
        $parentRoles = $this->Role->ParentRole->find('list');
        $this->set(compact('parentRoles'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->Role->delete()) {
            $this->Session->setFlash(__('Role deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Role was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * user_index method
     *
     * @return void
     */
    public function user_index()
    {
        $this->Role->recursive = 0;
        $this->set('roles', $this->paginate());
    }

    /**
     * user_view method
     *
     * @param string $id
     * @return void
     */
    public function user_view($id = null)
    {
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $this->set('role', $this->Role->read(null, $id));
    }

    /**
     * user_add method
     *
     * @return void
     */
    public function user_add()
    {
        if ($this->request->is('post')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }
        }
        $parentRoles = $this->Role->ParentRole->find('list');
        $this->set(compact('parentRoles'));
    }

    /**
     * user_edit method
     *
     * @param string $id
     * @return void
     */
    public function user_edit($id = null)
    {
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Role->save($this->request->data)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Role->read(null, $id);
        }
        $parentRoles = $this->Role->ParentRole->find('list');
        $this->set(compact('parentRoles'));
    }

    /**
     * user_delete method
     *
     * @param string $id
     * @return void
     */
    public function user_delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->Role->delete()) {
            $this->Session->setFlash(__('Role deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Role was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * beforeFilter function
     *
     * @return void
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }
}
