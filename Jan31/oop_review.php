<?php

// This interface may be implemented by any class wishing to 
// return an array that shall represent it when it is to be
// converted to JSON
interface JSONifyable {
    public function getJsonArray();
}

/**
 * Converts an arroy or class that implements JSONifyable
 * to a JSON string.
 * 
 * @param $json The array or JSONifyable object
 * @return String A JSON string
 */
function json_encode_better($json) {
    if ($json instanceof JSONifyable)
        return json_encode ($json->getJsonArray ());
    return json_encode($json);
}

/**
 * This wasn't covered in class, but it's a good example of an
 * abstract class. Many database objects have an id, right? So,
 * we can isolate this id into a class by itself that each class
 * that also has an id can extend.
 * 
 * This class is abstract since no object is just an id alone (typically...)
 * 
 */
abstract class EntityWithId {
    protected $id;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }


}

/**
 * A wall post that extends EntityWithId since a WallPost also
 * has an ID. It implements JSONifyable since it provides a mechanism
 * to be turned into a JSON array.
 * 
 * Comments have been added as an example of a one-to-many relationship.
 * Please see last semesters slides for an explanation.
 */
class WallPost extends EntityWithId implements JSONifyable {
    private $posterName;
    private $postContent;
    
    private $comments;
    
    function __construct($id, $posterName, $postContent) {
        $this->id = $id;
        $this->posterName = $posterName;
        $this->postContent = $postContent;
        
        $this->comments = array();
    }
    
    public function addComment($comment) {
        array_push($this->comments, $comment);
    }
    
    public function getJsonArray() {
        return array(
            'id' => $this->id,
            'posterName' => $this->posterName,
            'postContent' => $this->postContent,
            'comments' => $this->comments
        );
    }    
    
    public function getPosterName() {
        return $this->posterName;
    }

    public function setPosterName($posterName) {
        $this->posterName = $posterName;
    }

    public function getPostContent() {
        return $this->postContent;
    }

    public function setPostContent($postContent) {
        $this->postContent = $postContent;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }


}

class WallPostComment extends EntityWithId implements JSONifyable {
    private $comment;
    
    function __construct($comment) {
        $this->comment = $comment;
    }

    
    public function getJsonArray() {
        return array(
            'id' => $this->id,
            'comment' => $this->comment
        );
    }    
    
    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }


}

$post = new WallPost(123, "Buster", "Hey brother");
echo json_encode_better($post);
echo json_encode($post);

?>
