<?php

namespace Lance\Sofascore;

use \Lance\Setting;
use \GuzzleHttp\Client as gClient;
use \GuzzleHttp\Psr7\Request as gRequest;

class Events
{

    public $team = NULL;

    public $event = NULL;

    public function __construct()
    {

    }

    public function get(int $id)
    {
        try {
            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/event/' . $id);
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->event = json_decode($body)->event;
                return $this;

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }


    public function getId()
    {
        try {

           return $this->event->id;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getHomeTeam(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }
 
           return $this->event->homeTeam;

        } catch (\Exception $e) {

            return NULL;
        }
    }


    public function getAwayTeam(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

            return $this->event->awayTeam;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getTournament(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return $this->event->tournament;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getReferee(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return $this->event->referee;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }
 
    public function getLocale(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return $this->event->venue;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getStadium(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return $this->event->venue->stadium;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }


    public function getStatus(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return $this->event->status;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getStartDate(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

           return (object)[
             'time' => $this->event->startTimestamp,
             'date' => date('Y-m-d H:i:s', $this->event->startTimestamp)
           ];
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function homeScore(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

            return $this->event->homeScore;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }
   
    public function awayScore(int $id = NULL)
    {
        try {

            if($id != NULL){
                self::get($id);
            }

            return $this->event->awayScore;
  
        } catch (\Exception $e) {

            return NULL;
        }
    }

}