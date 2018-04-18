<?php

class NewsController
{
    public function actionIndex()
    {
        echo 'News list';
        return true;
    }

    public function actionView($catagory, $id)
    {
        echo "View one news";
        // here
        return true;
    }
}