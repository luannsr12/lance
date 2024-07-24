<?php

namespace Lance\Sofascore;

use \Lance\Setting;
use \GuzzleHttp\Client as gClient;
use \GuzzleHttp\Psr7\Request as gRequest;

class Team
{

    public $team = NULL;

    public $next_events = NULL;

    public function __construct()
    {

    }

    public function get(int $id)
    {
        try {
            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/team/' . $id);
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->team = json_decode($body)->team;
                return $this;

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getNextEvents(int $id = NULL)
    {
        try {

            $team_id = $id == NULL ? $this->team->id : $id;

            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/team/' . $team_id . '/events/next/0');
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->next_events = json_decode($body)->events;
                return $this->next_events;

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }


    public function getLastEvents(int $id = NULL)
    {
        try {

            $team_id = $id == NULL ? $this->team->id : $id;

            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/team/' . $team_id . '/events/last/0');
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->next_events = json_decode($body)->events;
                return $this->next_events;

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function nextEvent(int $id = NULL)
    {
        try {

            $team_id = $id == NULL ? $this->team->id : $id;

            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/team/' . $team_id . '/events/next/0');
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->next_events = json_decode($body)->events;
                return $this->next_events[0];

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function lastEvent(int $id = NULL)
    {
        try {

            $team_id = $id == NULL ? $this->team->id : $id;

            $setting = new Setting();
            $client = new gClient();
            $request = new gRequest('GET', $setting->getEndpointSofascore() . '/team/' . $team_id . '/events/last/0');
            $res = $client->sendAsync($request)->wait();
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();

            if ($statusCode == 200) {

                $this->next_events = json_decode($body)->events;
                $l = (array) $this->next_events;
                return (object) end($l);

            } else {
                return NUll;
            }

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getLogo(int $id = NULL, string $size = "")
    {
        try {

            $team_id = $id == NULL && $id != 'small' ? $this->team->id : $id;

            switch ($size) {
                case 'small':
                    $size = 'small';
                    break;
                default:
                    $size = '';
                    break;
            }

            $setting = new Setting();
            return $setting->getEndpointSofascore() . '/team/' . $team_id . '/image/' . $size;

        } catch (\Exception $e) {

            return NULL;
        }
    }


    public function getId()
    {
        try {

            return $this->team->id;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getName(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->name;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getNameCode(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->nameCode;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getFullName(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->fullName;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getColors(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->teamColors;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getManager(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->manager;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getLocale(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->venue;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getStadium(int $id = NULL)
    {
        try {

            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->venue->stadium;

        } catch (\Exception $e) {

            return NULL;
        }
    }

    public function getCountry(int $id = NULL)
    {
        try {
            
            if ($id != NULL) {
                self::get($id);
            }

            return $this->team->country;

        } catch (\Exception $e) {

            return NULL;
        }
    }

}