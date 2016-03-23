<?php
require 'vendor/autoload.php';

$app = new Slim\App();



// GET route
$app->get(
    '/',
    function () {
        $sql = "SELECT * FROM user";
        try {
            $db = DB_Connection();
            $user = $db->query($sql);
            $list = $user->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($list);
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);

// GET route
$app->get(
    '/post',
    function () {
        $sql = "SELECT * FROM user";
        try {
            $db = DB_Connection();
            $user = $db->query($sql);
            $list = $user->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($list);
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);

$app->get(
    '/:id',
    function ($id) {
        $sql = "SELECT * FROM user WHERE id=".$id;
        try {
            $db = DB_Connection();
            $user = $db->query($sql);
            $list = $user->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($list);
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);


// POST route
$app->post(
    '/post',
    function () {
        $request = \Slim\Slim::getInstance()->request();
        $user = json_decode($request->getBody());
        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        try {
            $db = DB_Connection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $user->username);
            $stmt->bindParam("password", $user->password);
            $status = $stmt->execute();
            $db = null;
            echo '{"status":'.$status.'}';
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);

// PUT route
$app->put(
    '/put/:id',
    function ($id) {
        $request = \Slim\Slim::getInstance()->request();
        $user = json_decode($request->getBody());
        $sql = "UPDATE user SET username=:username, password=:password WHERE id=:id";
        try {
            $db = DB_Connection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $user->username);
            $stmt->bindParam("password", $user->password);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $db = null;
            echo json_encode($user);
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete/:id',
    function ($id) {
        $sql = "DELETE FROM user WHERE id=".$id;
        try {
            $db = DB_Connection();
            $stmt = $db->query($sql);
            $db = null;
            echo '删除成功';
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
);



/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */

$app->run();
