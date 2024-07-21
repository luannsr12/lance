<?php

namespace Lance\Sofascore;

use \Lance\Setting;
use \GuzzleHttp\Client as gClient;
use \GuzzleHttp\Psr7\Request as gRequest;

class Torneios
{

   public string $country = "BR";

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

            return json_decode($body);

         } else {
            return NUll;
         }

      } catch (\Exception $e) {

         return NULL;
      }
   }

   public function getLogo(int $id)
   {
      try {

         $setting = new Setting();
         return $setting->getEndpointSofascore() . '/unique-tournament/' . $id . '/image';

      } catch (\Exception $e) {

         return NULL;
      }
   }


}