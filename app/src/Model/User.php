<?php
namespace Tutorial\Model;

use Tutorial\Table;

class User
{
    const HASH_KEY = 'sbcert_hashing_key';

    public static function getById($id) { return Table\Users::findById($id); }

    public function save($form,$id=0) {
        $user = (!$id) ? $this->createUser($form) : $this->registerUser($form,$id);
        $user->save();
        return $user->id;
    }
    private function hashPassword($password) { return sha1(User::HASH_KEY . $password. uniqid()); }
    private function createUser ($form) {
        $user = new Table\Users([
            'email' => (!empty($form['email']) ? $form['email'] : NULL),
            'type' => (!empty($form['type']) ? $form['type'] : NULL),
            'status' => 'created',
        ]);
        return $user;
    }

    private function registerUser ($form,$id) {
        $user = $this::getById($id);
            if (!$user) {
                return 0;
            }
        $user->first_name = (!empty($form['first_name']) ? $form['first_name'] : $user->first_name);
        $user->last_name = (!empty($form['last_name']) ? $form['last_name'] : $user->last_name);
        $user->pass = (!empty($form['password']) ? $this->hashPassword($form['pass']) : $user->pass);
        $user->status = 'confirmed';
        return $user;
    }

}