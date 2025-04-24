<?php 
global $db;
require_once(CLASSES."/Validator.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $fillable = ['title', 'excerpt', 'content'];

    $data = loadPOSTData($fillable);

    // $data = [
    //     'title' => 'Test post Title',
    //     'excerpt' => 'Test post Excerpt',
    //     'content' => 'Test post Content',
    //     'email' => 'mail@mail.com',
    //     'password' => '12345',
    //     'password_confirm' => '12345',
    // ];

    //rules fo each input array
    $rules = [
        'title' => [
            'required' => true,
            'min' => 5,
            'max' => 50,
        ],
        'excerpt' => [
            'required' => true,
            'min' => 10,
            'max' => 150,
        ],
        'content' => [
            'required' => true,
            'min' => 10,
        ],
        'email' => [
            'email' => true,
        ],
        'password' => [
            'required' => true,
            'min' => 2,
        ],
        'password_confirm' => [
            'match' => 'password',
            'min' => 2,
        ]
    ];

    $validator = new Validator();
    $validationResult = $validator->validate(
        $data = [
        'title' => 'Test post Title',
        'excerpt' => 'Test post Excerpt',
        'content' => 'Test post Content',
        'email' => 'mail@mail.com',
        'password' => '12345',
        'password_confirm' => '12345',
    ], 
    $rules);
    $validationResult->hasErrors();

    //dd($data);
    if (empty($data['title'])) {
        $errors['title'] = "Post title is required";
    }
    if (empty($data['content'])) {
        $errors['content'] = "Post content is required";
    }
    if (empty($data['excerpt'])) {
        $errors['excerpt'] = "Post excerpt is required";
    }

    if (!$validationResult->hasErrors()) {
        $sql = "SELECT `post_id` FROM `posts` ORDER BY `post_id` DESC LIMIT 1";
        $id = $db->query($sql)->find()['post_id'];
        $slug = 'post-' . ++$id;

        $sql = 'INSERT INTO `posts` (`title`, `slug`, `excerpt`, `content`) VALUES (:title, :slug, :excerpt, :content)';
        if ($db->query($sql, ['title'=>$data['title'], 'slug'=>$slug, 'excerpt'=>$data['excerpt'], 'content'=>$data['content'],]))
        {
            $_SESSION['success'] = "Post created successfully";
        }
        else {
            $_SESSION['error'] = "Database error";
        }
    }
    redirect('/');

}