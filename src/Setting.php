<?php 
 
 namespace Lance;

 class Setting{

    public string $endpoint_sofascore = "https://api.sofascore.com/api/v1/";

    public function getEndpointSofascore(){
        return rtrim($this->endpoint_sofascore, '/');
    }

 }