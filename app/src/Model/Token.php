<?php
namespace Tutorial\Model;

use Tutorial\Table;
class Token
{
    const TOKEN_KEY = 'f=_1~uy%f78*%6x=!gb';
    protected $token;
    public function __construct($email = '')
    {
        $this->token = $this->generateToken($email);
    }
    public static function getUserId($token_id)
    {
        $token = Table\Tokens::findOne(['token' => $token_id]);
        return isset($token->user_id) ? $token->user_id : 0;
    }
    public function getById($id)
    {
        return Table\Tokens::findById($id);
    }
    public function save($user_id = 0)
    {
        if ($user_id) {
            $this->remove($user_id);
            $fields = [
                'token' => $this->token,
                'user_id' => $user_id,
                'created' => date('U'),
            ];
            $token = new Table\Tokens($fields);
            $token->save();
            return $token->token;
        }
    }
    public function remove($user_id)
    {
        $token = Table\Tokens::findOne(['user_id' => $user_id]);
        if (isset($token->token)) {
            $token->delete();
        }
    }
    private function generateToken($email) { return sha1(Token::TOKEN_KEY . $email . uniqid()); }
}