<?php

class Feedparser
{
    protected $url=null;
    protected $xml_doc=null;

    const FEED_TYPE_UNKNOW = 0;
    const FEED_TYPE_RSS = 1;
    const FEED_TYPE_ATOM = 2;

    protected $feed_type = self::FEED_TYPE_UNKNOW;


    function __construct($url=null)
    {
        if($url!=null) $this->setUrl($url);
    }


    private function fetchFeed()
    {
        if($this->getUrl() == null) throw new Exception('Aucune URL.');

        $this->xml_doc = new SimpleXMLIterator($this->url, LIBXML_NOCDATA, true);
        if(isset($this->xml_doc->channel))
            $this->feed_type=self::FEED_TYPE_RSS;
        elseif(isset($this->xml_doc->entry))
            $this->feed_type=self::FEED_TYPE_ATOM;
        else
            $this->feed_type=self::FEED_TYPE_UNKNOW;
    }

    public function parse($nb = null)
    {
        if($this->xml_doc==null)
            $this->fetchFeed();

        switch($this->feed_type)
        {
            case self::FEED_TYPE_RSS:
            case self::FEED_TYPE_ATOM:
            return $this->parseRSSATOM($nb);
            break;
            default:
            throw new Exception('Rien à parser');
        }
    }

    /* PARSERS */
    protected function parseRSSATOM($nb = null)
    {
        $retour = new ArrayIterator();
        $newsList=null;

        if($this->feed_type==self::FEED_TYPE_RSS)
            $newsList=$this->xml_doc->channel->item;
        elseif($this->feed_type==self::FEED_TYPE_ATOM)
            $newsList=$this->xml_doc->entry;

        $i = 0;
        foreach($newsList as $item)
        {
           $retour->append(new ArrayObject((array) $item, ArrayObject::ARRAY_AS_PROPS));

           if($nb != null && intval($nb) == ++$i) break;
       }

       return $retour;
   }


   /* GETTER / SETTER */
   public function setUrl($url)
   {
       if(filter_var($url, FILTER_VALIDATE_URL,FILTER_FLAG_SCHEME_REQUIRED)===$url)
       {
        $this->url=$url;
        return true;
    }
    throw new Exception('URL invalide');
}

public function getUrl()
{
    return ((strlen($this->url)>0)?$this->url:null);
}

public function getType()
{
    return $this->feed_type;
}
}
?>
