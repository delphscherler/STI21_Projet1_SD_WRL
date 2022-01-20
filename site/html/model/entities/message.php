<?php
require_once __DIR__.'/entity.php';

class Message extends Entity {
    protected static $_table = 'messages';
    protected static $_class = 'Message';

    protected static $db_fields = ['id', 'sender', 'receiver', 'subject', 'date', 'message'];

    protected $id;
    protected $sender = 0;
    protected $receiver = 0;
    protected $subject = '';
    protected $date = '';
    protected $message = '';

    public static function getAll($filters = []) {

        $filters = array_merge([
            'receiver' => null,
        ], $filters);

        $where = '';

        if ($filters['receiver']) {
            $where .= ' receiver = :receiver';
        }

        return (new Message())->findAll($where, $filters);
    }
}