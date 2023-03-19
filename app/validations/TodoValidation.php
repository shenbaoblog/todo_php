<?php


class TodoValidation {
    protected $user_id;
    protected $title;
    protected $details;
    protected $status;
    protected $message = [];

    function __construct($todo_data) {
        $this->user_id = $todo_data['user_id'];
        $this->title = $todo_data['title'];
        $this->details = $todo_data['details'];
        $this->status = $todo_data['status'];
    }

    public function validation() {
        if($this->title === "") {
            $this->message[] = "※タイトルを入力してください。";
            return false;
        } else {
            return true;
        }
    }

    public function getErrorMsg() {
        return $this->message;
    }

    public function getValidData() {
        return [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'details' => $this->details,
            'status' => $this->status,
        ];
    }
}
