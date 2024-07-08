<?php
// on va utiliser notre manager de commentaires
use model\Manager\TagManager;
// on va utiliser notre classe de mapping de commentaires



// create comment Manager
$tagManager = new TagManager($dbConnect);



// detail view
if(isset($_GET['view'])&&ctype_digit($_GET['view'])){
    $idComment = (int) $_GET['view'];
    // select one comment
    $selectOneTag = $tagManager->selectOneById($idTag);
    // view
    require "../view/comment/selectOneComment.view.php";

// insert comment page
}elseif(isset($_GET['insert'])){

// real insert comment
    if(isset($_POST['comment_text'])) {
        try{
            // create comment
            $comment = new TagMapping($_POST);
            // set date
            $comment->setTagDatePublish(new DateTime());
            // insert comment
            $insertTag = $tagManager->insert($comment);

            if($insertTag===true) {
                header("Location: ./?route=tag");
                exit();
            }else{
                $error = $insertTag;
            }
        }catch(Exception $e){
            $error = $e->getMessage();
        }
        //var_dump($comment);

    }
    // view
    require "../view/tag/insertTag.view.php";

// delete comment
}elseif (isset($_GET['update'])&&ctype_digit($_GET['update'])) {
    $idTag = (int)$_GET['update'];

    // update comment
    if (isset($_POST['tag_text'])) {
        try {
            // create comment
            $tag = new TagMapping($_POST);
            $comment->setTagId($idTag);
            // update comment
            $updateTag = $tagManager->update($tag);
            if($updateComment===true) {
                header("Location: ./?route=tag");
                exit();
            }else{
                $error = $updateTag;
            }
        }catch (Exception $e) {
            $error = $e->getMessage();
        }

    }
    // select one comment
    $selectOneTag = $tagManager->selectOneById($idTag);
    // view
    require "../view/comment/updateComment.view.php";

// delete comment
}elseif(isset($_GET['delete'])&&ctype_digit($_GET['delete'])){
    $idTag = (int) $_GET['delete'];
    // delete comment
    $deleteTag = $tagManager->delete($idTag);
    if($deleteTag===true) {
        header("Location: ./?route=tag");
        exit();
    }else{
        $error = $deleteTag;
    }

// homepage
}else{
    // select all comments
    $selectAllTags = $tagManager->selectAll();
    // view
    require "../view/tag/selectAllTag.view.php";
}