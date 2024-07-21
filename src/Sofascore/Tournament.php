<?php

namespace Lance\Sofascore;

use \Lance\Setting;
use \GuzzleHttp\Client as gClient;
use \GuzzleHttp\Psr7\Request as gRequest;

class Tournament
{

   public string $country = "BR";

   public $tournament = NULL;

   public $tournament_season = NULL;

   public function __construct()
   {

   }

   public function list()
   {
      try {

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/config/unique-tournaments/' . $this->country);
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {
            return json_decode($body);
         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }


   public function search(string $searchTerm)
   {
      try {

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/search/all?q=' . $searchTerm);
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {

           return isset(json_decode($body)->results) ? json_decode($body)->results : NULL;

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function get(int $id)
   {
      try {

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/unique-tournament/' . $id);
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {

            $this->tournament = json_decode($body);
 
            return $this;

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function getLogo()
   {
      try {

         $tournament_id = $this->tournament->uniqueTournament->id;

         $setting = new Setting();
         return $setting->getEndpointSofascore() . '/unique-tournament/' . $tournament_id . '/image';

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function getName()
   {
      try {
         return $this->tournament->uniqueTournament->name;
      } catch (\Exception $e) {
         return NULL;
      }
   }

   public function getSlug()
   {
      try {
         return $this->tournament->uniqueTournament->slug;
      } catch (\Exception $e) {
         return NULL;
      }
   }

   public function getColors()
   {
      try {
         return (object)[
            'primary'   => $this->tournament->uniqueTournament->primaryColorHex,
            'secondary' => $this->tournament->uniqueTournament->secondaryColorHex
         ];
      } catch (\Exception $e) {
         return NULL;
      }
   }

   public function getCurrentChampion()
   {
      try {
         return $this->tournament->uniqueTournament->titleHolder;
      } catch (\Exception $e) {
         return NULL;
      }
   }
 
   public function getSeasons(int $id = 0)
   {
      try {

         if($id < 1){
            $id = $this->tournament->uniqueTournament->id;
         }

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/unique-tournament/'. $id.'/seasons');
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {

            return json_decode($body);

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function getSeason(int $id, int $season_id)
   {
      try {

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/unique-tournament/'.$id.'/season/'.$season_id.'/standings/total');
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {

            $this->tournament_season = json_decode($body);

            return $this->tournament_season;

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function getTeams(int $id = 0, int $season_id = 0)
   {
      try {

         if($id < 1){
            $id = $this->tournament->uniqueTournament->id;
         }

         if($season_id < 1){
            $seasons = $this->getSeasons($id);
            if($seasons){
               $season_id = $seasons->seasons[0]->id;
               $session_get = $this->getSeason($id, $season_id);
               if($session_get === NULL){
                  $season_id = $seasons->seasons[1]->id;
               }
            }
         }

         $setting = new Setting();
         $client = new gClient();
         $request = new gRequest('GET', $setting->getEndpointSofascore() . '/unique-tournament/'.$id.'/season/'.$season_id.'/standings/total');
         $res = $client->sendAsync($request)->wait();
         $statusCode = $res->getStatusCode();
         $body = $res->getBody()->getContents();

         if ($statusCode == 200) {

            if(isset(json_decode($body)->standings)){

               $standings = json_decode($body)->standings;
               
               $teams = [];
               $i=0;

               foreach($standings as $k => $groups){

                  if(isset($groups->rows)){

                     foreach($groups->rows as $k1 => $t){
                        $teams[$i] = $t;
                        $i++;
                     }

                  }
               }

               return $teams;

            }

            return NUll;

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

}