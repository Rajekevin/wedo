<?php

class rssController
{

	
    public function listAction($args) {
        $view = new View();
        $view->setView("rss/show");
    }

	public function feedAction($args) {
        header("Content-Type: application/rss+xml; charset=ISO-8859-1");

            $args_access = ["musculation", "fitness", "all"];
            if( !empty( $args ) && in_array($args[0], $args_access, true) )
            {

                $feed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
                $feed .= '<rss version="2.0">';
                $feed .= '<channel>';
                $feed .= '<title>My RSS feed '.$args[0].' </title>';
                $feed .= '<link> '. WEBROOT. 'rss/feed/'. $args[0]. ' </link>';
                $feed .= '<description>My Latest cool '.$args[0]. ' ! </description>';
                $feed .= '<language>en-us</language>';
                $feed .= '<copyright>Copyright (C) 2016 wedo</copyright>';

    
                  if($args[0] == "musculation" )
                {
                   
                
                     $articles = Article::findAll();
                   
                    foreach($articles as $key => $article)
                    {
                        $feed .= '<item>';
                        $feed .= '<title> Article : ' . $article->getTitle() . '</title>';
                        $feed .= '<description>' . $article->getDescription() . '</description>';
                        $feed .= '<link> '. WEBROOT. 'article/musculation/'.$article->getTitle().' </link>';
                        $feed .= '<pubDate>' . date("Y-m-d H:i:s", strtotime($article->getDate() )) . '</pubDate>';
                        $feed .= '</item>';
                    }
                
         
                }

                $feed .= '</channel>';
                $feed .= '</rss>';

            }
            else
            {
                $feed = "THIS FEED NOT EXIST";
            }

            echo $feed;

        }
    }
