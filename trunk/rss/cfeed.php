<?php
/**
 * Version recortada y aligerada de
 * FeedCreator class v1.7.2.
 */
define("TIME_ZONE","-06:00");
define("FEED_VERSION", "UES-FMOcc - Unidad de PostGrados v0.1");

// HtmlDescribable es un item dentro de un feed
// que puede tener una descripcion que pudiese incluir HTML
class HtmlDescribable {
    /**
     * Indicates whether the description field should be rendered in HTML.
     */
    var $descriptionHtmlSyndicated;  
    /**
     * Indicates whether and to how many characters a description should be truncated.
     */
    var $descriptionTruncSize;   
    /**
     * Returns a formatted description field, depending on descriptionHtmlSyndicated and
     * $descriptionTruncSize properties
     * @return    string    the formatted description  
     */
    function getDescription() {
        $descriptionField = new FeedHtmlField($this->description);
        $descriptionField->syndicateHtml = $this->descriptionHtmlSyndicated;
        $descriptionField->truncSize = $this->descriptionTruncSize;
        return $descriptionField->output();
    }
}

// FeedItem es un item parte de un feed generado por FeedLite
class FeedItem extends HtmlDescribable {
	//cualquier item de un feed debe poseer AL MENOS estos atributos
    var $title, $description, $link;
    //atributos opcionales
    var $author, $authorEmail, $image, $category, $comments, $guid, $source, $creator;
    /* Publishing date of an item. May be in one of the following formats:
     *
     *    RFC 822:
     *    "Mon, 20 Jan 03 18:05:41 +0400"
     *    "20 Jan 03 18:05:41 +0000"
     *
     *    ISO 8601:
     *    "2003-01-20T18:05:41+04:00"
     *
     *    Unix:
     *    1043082341
     */
    var $date;
    /* Any additional elements to include as an assiciated array. All $key => $value pairs
     * will be included unencoded in the feed item in the form
     *     <$key>$value</$key>
     * Again: No encoding will be used! This means you can invalidate or enhance the feed
     * if $value contains markup. This may be abused to embed tags not implemented by
     * the FeedCreator class used.
     */
    var $additionalElements = Array();
    // on hold
    // var $source;
}

// FeedImage puede agregarse a un feed de FeedLite
class FeedImage extends HtmlDescribable {
    //atributos obligatorios de una imagen
    var $title, $url, $link;
    //atributos opcionales
    var $width, $height, $description;
}

// Un FeedHtmlField describe y genera un feed y campos item o image html.
// La salida es generada en base a las propiedades $truncSize, $syndicateHtml.
class FeedHtmlField {
    //obligatorio
    var $rawFieldContent;
    //opcional
    var $truncSize, $syndicateHtml;
    
    /**
     * Creates a new instance of FeedHtmlField.
     * @param  $string: if given, sets the rawFieldContent property
     */
    function FeedHtmlField($parFieldContent) {
        if ($parFieldContent) {
            $this->rawFieldContent = $parFieldContent;
        }
    }
 
    /**
     * Creates the right output, depending on $truncSize, $syndicateHtml properties.
     * @return string    the formatted field
     */
    function output() {
        // when field available and syndicated in html we assume 
        // - valid html in $rawFieldContent and we enclose in CDATA tags
        // - no truncation (truncating risks producing invalid html)
        if (!$this->rawFieldContent) {
            $result = "";
        }    elseif ($this->syndicateHtml) {
            $result = "<![CDATA[".$this->rawFieldContent."]]>";
        } else {
            if ($this->truncSize and is_int($this->truncSize)) {
                $result = FeedCreator::iTrunc(htmlspecialchars($this->rawFieldContent),$this->truncSize);
            } else {
                $result = htmlspecialchars($this->rawFieldContent);
            }
        }
        return $result;
    }
}

class FeedDate {
    var $unix;
    
    /**
     * Creates a new instance of FeedDate representing a given date.
     * Accepts RFC 822, ISO 8601 date formats as well as unix time stamps.
     * @param mixed $dateString optional the date this FeedDate will represent. If not specified, the current date and time is used.
     */
    function FeedDate($dateString="") {
        if ($dateString=="") $dateString = date("r");
        
        if (is_integer($dateString)) {
            $this->unix = $dateString;
            return;
        }
        if (preg_match("~(?:(?:Mon|Tue|Wed|Thu|Fri|Sat|Sun),\\s+)?(\\d{1,2})\\s+([a-zA-Z]{3})\\s+(\\d{4})\\s+(\\d{2}):(\\d{2}):(\\d{2})\\s+(.*)~",$dateString,$matches)) {
            $months = Array("Jan"=>1,"Feb"=>2,"Mar"=>3,"Apr"=>4,"May"=>5,"Jun"=>6,"Jul"=>7,"Aug"=>8,"Sep"=>9,"Oct"=>10,"Nov"=>11,"Dec"=>12);
            $this->unix = mktime($matches[4],$matches[5],$matches[6],$months[$matches[2]],$matches[1],$matches[3]);
            if (substr($matches[7],0,1)=='+' OR substr($matches[7],0,1)=='-') {
                $tzOffset = (substr($matches[7],0,3) * 60 + substr($matches[7],-2)) * 60;
            } else {
                if (strlen($matches[7])==1) {
                    $oneHour = 3600;
                    $ord = ord($matches[7]);
                    if ($ord < ord("M")) {
                        $tzOffset = (ord("A") - $ord - 1) * $oneHour;
                    } elseif ($ord >= ord("M") AND $matches[7]!="Z") {
                        $tzOffset = ($ord - ord("M")) * $oneHour;
                    } elseif ($matches[7]=="Z") {
                        $tzOffset = 0;
                    }
                }
                switch ($matches[7]) {
                    case "UT":
                    case "GMT":    $tzOffset = 0;
                }
            }
            $this->unix += $tzOffset;
            return;
        }
        if (preg_match("~(\\d{4})-(\\d{2})-(\\d{2})T(\\d{2}):(\\d{2}):(\\d{2})(.*)~",$dateString,$matches)) {
            $this->unix = mktime($matches[4],$matches[5],$matches[6],$matches[2],$matches[3],$matches[1]);
            if (substr($matches[7],0,1)=='+' OR substr($matches[7],0,1)=='-') {
                $tzOffset = (substr($matches[7],0,3) * 60 + substr($matches[7],-2)) * 60;
            } else {
                if ($matches[7]=="Z") {
                    $tzOffset = 0;
                }
            }
            $this->unix += $tzOffset;
            return;
        }
        $this->unix = 0;
    }

    /**
     * Gets the date stored in this FeedDate as an RFC 822 date.
     *
     * @return a date in RFC 822 format
     */
    function rfc822() {
        //return gmdate("r",$this->unix);
        $date = gmdate("D, d M Y H:i:s", $this->unix);
        if (TIME_ZONE!="") $date .= " ".str_replace(":","",TIME_ZONE);
        return $date;
    }
    
    /**
     * Gets the date stored in this FeedDate as an ISO 8601 date.
     *
     * @return a date in ISO 8601 format
     */
    function iso8601() {
        $date = gmdate("Y-m-d\TH:i:sO",$this->unix);
        $date = substr($date,0,22) . ':' . substr($date,-2);
        if (TIME_ZONE!="") $date = str_replace("+00:00",TIME_ZONE,$date);
        return $date;
    }
    
    /**
     * Gets the date stored in this FeedDate as unix time stamp.
     *
     * @return a date as a unix time stamp
     */
    function unix() {
        return $this->unix;
    }
}

// UniversalFeedCreator permite elegir en tiempo de ejecucion el formato del feed.
class UniversalFeedCreator extends FeedCreator {
    var $_feed;
    
    function _setFormat($format) {
        switch (strtoupper($format)) {
            
            case "2.0":
                // caemos al siguiente
            case "RSS2.0":
                $this->_feed = new RSSCreator20();
                break;
            case "HTML":
                $this->_feed = new HTMLCreator();
                break;
            default:
                $this->_feed = new RSSCreator091();
                break;
        }
        
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            // prevent overwriting of properties "contentType", "encoding"; do not copy "_feed" itself
            if (!in_array($key, array("_feed", "contentType", "encoding"))) {
                $this->_feed->{$key} = $this->{$key};
            }
        }
    }
    
    /**
     * Creates a syndication feed based on the items previously added.
     *
     * @see        FeedCreator::addItem()
     * @param    string    format    format the feed should comply to. Valid values are:
     *            "PIE0.1", "mbox", "RSS0.91", "RSS1.0", "RSS2.0", "OPML", "ATOM0.3", "HTML", "JS"
     * @return    string    the contents of the feed.
     */
    function createFeed($format = "RSS2.0") {
        $this->_setFormat($format);
        return $this->_feed->createFeed();
    }

    /* Saves this feed as a file on the local disk. After the file is saved, an HTTP redirect
     * header may be sent to redirect the use to the newly created file.
     * @since 1.4
     * 
     * @param    string    format    format the feed should comply to. Valid values are: "RSS2.0", "HTML"
     * @param    string    filename    optional    the filename where a recent version of the feed is saved. If not specified, the filename is $_SERVER["PHP_SELF"] with the extension changed to .xml (see _generateFilename()).
     * @param    boolean    displayContents    optional    send the content of the file or not. If true, the file will be sent in the body of the response.
     */
    function saveFeed($format="RSS2.0", $filename="", $displayContents=true) {
        $this->_setFormat($format);
        $this->_feed->saveFeed($filename, $displayContents);
    }

   /* Turns on caching and checks if there is a recent version of this feed in the cache.
    * If there is, an HTTP redirect header is sent.
    * To effectively use caching, you should create the FeedCreator object and call this method
    * before anything else, especially before you do the time consuming task to build the feed
    * (web fetching, for example).
    *
    * @param   string   format   format the feed should comply to. Valid values are:
    *       "PIE0.1" (deprecated), "mbox", "RSS0.91", "RSS1.0", "RSS2.0", "OPML", "ATOM0.3".
    * @param filename   string   optional the filename where a recent version of the feed is saved. If not specified, the filename is $_SERVER["PHP_SELF"] with the extension changed to .xml (see _generateFilename()).
    * @param timeout int      optional the timeout in seconds before a cached version is refreshed (defaults to 3600 = 1 hour)
    */
   function useCached($format="RSS2.0", $filename="", $timeout=3600) {
      $this->_setFormat($format);
      $this->_feed->useCached($filename, $timeout);
   }

}

class FeedCreator extends HtmlDescribable {
    /**
     * Mandatory attributes of a feed.
     */
    var $title, $description, $link; 
    /**
     * Optional attributes of a feed.
     */
    var $syndicationURL, $image, $language, $copyright, $pubDate, $lastBuildDate, $editor, $editorEmail, $webmaster, $category, $docs, $ttl, $rating, $skipHours, $skipDays;
    /**
    * The url of the external xsl stylesheet used to format the naked rss feed.
    * Ignored in the output when empty.
    */
    var $xslStyleSheet = ""; 
    /**
     * @access private
     */
    var $items = Array();
    /**
     * This feed's MIME content type.
     */
    var $contentType = "application/xml";
    
    /**
     * This feed's character encoding.
     **/
    var $encoding = "ISO-8859-1";
    /**
     * Any additional elements to include as an assiciated array. All $key => $value pairs
     * will be included unencoded in the feed in the form
     *     <$key>$value</$key>
     * Again: No encoding will be used! This means you can invalidate or enhance the feed
     * if $value contains markup. This may be abused to embed tags not implemented by
     * the FeedCreator class used.
     */
    var $additionalElements = Array();
    /**
     * Adds an FeedItem to the feed.
     *
     * @param object FeedItem $item The FeedItem to add to the feed.
     * @access public
     */
    function addItem($item) {
        $this->items[] = $item;
    }

    /* Truncates a string to a certain length at the most sensible point.
     * First, if there's a '.' character near the end of the string, the string is truncated after this character.
     * If there is no '.', the string is truncated after the last ' ' character.
     * If the string is truncated, " ..." is appended.
     * If the string is already shorter than $length, it is returned unchanged.
     * 
     * @static
     * @param string    string A string to be truncated.
     * @param int        length the maximum length the string should be truncated to
     * @return string    the truncated string
     */
    function iTrunc($string, $length) {
        if (strlen($string)<=$length) {
            return $string;
        }
        
        $pos = strrpos($string,".");
        if ($pos>=$length-4) {
            $string = substr($string,0,$length-4);
            $pos = strrpos($string,".");
        }
        if ($pos>=$length*0.4) {
            return substr($string,0,$pos+1)." ...";
        }
        
        $pos = strrpos($string," ");
        if ($pos>=$length-4) {
            $string = substr($string,0,$length-4);
            $pos = strrpos($string," ");
        }
        if ($pos>=$length*0.4) {
            return substr($string,0,$pos)." ...";
        }
        
        return substr($string,0,$length-4)." ...";
            
    }
    
    
    /**
     * Creates a comment indicating the generator of this feed.
     * The format of this comment seems to be recognized by
     * Syndic8.com.
     */
    function _createGeneratorComment() {
        return "<!-- generator=\"".FEED_VERSION."\" -->\n";
    }
    
    
    /**
     * Creates a string containing all additional elements specified in
     * $additionalElements.
     * @param    elements    array    an associative array containing key => value pairs
     * @param indentString    string    a string that will be inserted before every generated line
     * @return    string    the XML tags corresponding to $additionalElements
     */
    function _createAdditionalElements($elements, $indentString="") {
        $ae = "";
        if (is_array($elements)) {
            foreach($elements AS $key => $value) {
                $ae.= $indentString."<$key>$value</$key>\n";
            }
        }
        return $ae;
    }
    
    function _createStylesheetReferences() {
        $xml = "";
        if ($this->cssStyleSheet) $xml .= "<?xml-stylesheet href=\"".$this->cssStyleSheet."\" type=\"text/css\"?>\n";
        if ($this->xslStyleSheet) $xml .= "<?xml-stylesheet href=\"".$this->xslStyleSheet."\" type=\"text/xsl\"?>\n";
        return $xml;
    }
    
    
    /**
     * Builds the feed's text.
     * @abstract
     * @return    string    the feed's complete text 
     */
    function createFeed() {
    }
    
    /**
     * Generate a filename for the feed cache file. The result will be $_SERVER["PHP_SELF"] with the extension changed to .xml.
     * For example:
     * 
     * echo $_SERVER["PHP_SELF"]."\n";
     * echo FeedCreator::_generateFilename();
     * 
     * would produce:
     * 
     * /rss/latestnews.php
     * latestnews.xml
     *
     * @return string the feed cache filename
     * @since 1.4
     * @access private
     */
    function _generateFilename() {
        //$fileInfo = pathinfo($_SERVER["PHP_SELF"]);
        //return substr($fileInfo["basename"],0,-(strlen($fileInfo["extension"])+1)).".xml";
    }
    
    function _redirect($filename) {
        // attention, heavily-commented-out-area
        // maybe use this in addition to file time checking
        //Header("Expires: ".date("r",time()+$this->_timeout));
        /* no caching at all, doesn't seem to work as good:
        Header("Cache-Control: no-cache");
        Header("Pragma: no-cache");
        */
        // HTTP redirect, some feed readers' simple HTTP implementations don't follow it
        //Header("Location: ".$filename);

        Header("Content-Type: ".$this->contentType."; charset=".$this->encoding."; filename=".basename($filename));
        Header("Content-Disposition: inline; filename=".basename($filename));
        readfile($filename, "r");
        die();
    }
    
    /**
     * Turns on caching and checks if there is a recent version of this feed in the cache.
     * If there is, an HTTP redirect header is sent.
     * To effectively use caching, you should create the FeedCreator object and call this method
     * before anything else, especially before you do the time consuming task to build the feed
     * (web fetching, for example).
     * @since 1.4
     * @param filename    string    optional    the filename where a recent version of the feed is saved. If not specified, the filename is $_SERVER["PHP_SELF"] with the extension changed to .xml (see _generateFilename()).
     * @param timeout    int        optional    the timeout in seconds before a cached version is refreshed (defaults to 3600 = 1 hour)
     */
    function useCached($filename="", $timeout=3600) {
        $this->_timeout = $timeout;
        if ($filename=="") {
            $filename = $this->_generateFilename();
        }
        if (file_exists($filename) AND (time()-filemtime($filename) < $timeout)) {
            $this->_redirect($filename);
        }
    }
    
    
    /**
     * Saves this feed as a file on the local disk. After the file is saved, a redirect
     * header may be sent to redirect the user to the newly created file.
     * @since 1.4
     * 
     * @param filename    string    optional    the filename where a recent version of the feed is saved. If not specified, the filename is $_SERVER["PHP_SELF"] with the extension changed to .xml (see _generateFilename()).
     * @param redirect    boolean    optional    send an HTTP redirect header or not. If true, the user will be automatically redirected to the created file.
     */
    function saveFeed($filename="", $displayContents=true) {
        //if ($filename=="") {
            //$filename = $this->_generateFilename();
            //$filename = $fileInfo["basename"] . ".xml";
        //}
        //$feedFile = fopen($filename, "w+");
        //if ($feedFile) {
            //fputs($feedFile,$this->createFeed());
            //fclose($feedFile);
            //if ($displayContents) {
                //$this->_redirect($filename);
                //$this->_redirect($this->createFeed());
            //}
        /*} else {
            echo "<br /><b>Error creating feed file, please check write permissions.</b><br />";
        }*/
    }
    
}

class RSSCreator091 extends FeedCreator {
    /**
     * Stores this RSS feed's version number.
     * @access private
     */
    var $RSSVersion;

    function RSSCreator091() {
        $this->_setRSSVersion("0.91");
        $this->contentType = "application/rss+xml";
    }
    
    /**
     * Sets this RSS feed's version number.
     * @access private
     */
    function _setRSSVersion($version) {
        $this->RSSVersion = $version;
    }

    /**
     * Builds the RSS feed's text. The feed will be compliant to RDF Site Summary (RSS) 1.0.
     * The feed will contain all items previously added in the same order.
     * @return    string    the feed's complete text 
     */
    function createFeed() {
        $feed = "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\n";
        $feed.= $this->_createGeneratorComment();
        $feed.= $this->_createStylesheetReferences();
        $feed.= "<rss version=\"".$this->RSSVersion."\">\n"; 
        $feed.= "    <channel>\n";
        $feed.= "        <title>".FeedCreator::iTrunc(htmlspecialchars($this->title),100)."</title>\n";
        $this->descriptionTruncSize = 500;
        $feed.= "        <description>".$this->getDescription()."</description>\n";
        $feed.= "        <link>".$this->link."</link>\n";
        $now = new FeedDate();
        $feed.= "        <lastBuildDate>".htmlspecialchars($now->rfc822())."</lastBuildDate>\n";
        $feed.= "        <generator>".FEED_VERSION."</generator>\n";

        if ($this->image!=null) {
            $feed.= "        <image>\n";
            $feed.= "            <url>".$this->image->url."</url>\n"; 
            $feed.= "            <title>".FeedCreator::iTrunc(htmlspecialchars($this->image->title),100)."</title>\n"; 
            $feed.= "            <link>".$this->image->link."</link>\n";
            if ($this->image->width!="") {
                $feed.= "            <width>".$this->image->width."</width>\n";
            }
            if ($this->image->height!="") {
                $feed.= "            <height>".$this->image->height."</height>\n";
            }
            if ($this->image->description!="") {
                $feed.= "            <description>".$this->image->getDescription()."</description>\n";
            }
            $feed.= "        </image>\n";
        }
        if ($this->language!="") {
            $feed.= "        <language>".$this->language."</language>\n";
        }
        if ($this->copyright!="") {
            $feed.= "        <copyright>".FeedCreator::iTrunc(htmlspecialchars($this->copyright),100)."</copyright>\n";
        }
        if ($this->editor!="") {
            $feed.= "        <managingEditor>".FeedCreator::iTrunc(htmlspecialchars($this->editor),100)."</managingEditor>\n";
        }
        if ($this->webmaster!="") {
            $feed.= "        <webMaster>".FeedCreator::iTrunc(htmlspecialchars($this->webmaster),100)."</webMaster>\n";
        }
        if ($this->pubDate!="") {
            $pubDate = new FeedDate($this->pubDate);
            $feed.= "        <pubDate>".htmlspecialchars($pubDate->rfc822())."</pubDate>\n";
        }
        if ($this->category!="") {
            $feed.= "        <category>".htmlspecialchars($this->category)."</category>\n";
        }
        if ($this->docs!="") {
            $feed.= "        <docs>".FeedCreator::iTrunc(htmlspecialchars($this->docs),500)."</docs>\n";
        }
        if ($this->ttl!="") {
            $feed.= "        <ttl>".htmlspecialchars($this->ttl)."</ttl>\n";
        }
        if ($this->rating!="") {
            $feed.= "        <rating>".FeedCreator::iTrunc(htmlspecialchars($this->rating),500)."</rating>\n";
        }
        if ($this->skipHours!="") {
            $feed.= "        <skipHours>".htmlspecialchars($this->skipHours)."</skipHours>\n";
        }
        if ($this->skipDays!="") {
            $feed.= "        <skipDays>".htmlspecialchars($this->skipDays)."</skipDays>\n";
        }
        $feed.= $this->_createAdditionalElements($this->additionalElements, "    ");

        for ($i=0;$i<count($this->items);$i++) {
            $feed.= "        <item>\n";
            $feed.= "            <title>".FeedCreator::iTrunc(htmlspecialchars(strip_tags($this->items[$i]->title)),100)."</title>\n";
            $feed.= "            <link>".htmlspecialchars($this->items[$i]->link)."</link>\n";
            $feed.= "            <description>".$this->items[$i]->getDescription()."</description>\n";
            
            if ($this->items[$i]->author!="") {
                $feed.= "            <author>".htmlspecialchars($this->items[$i]->author)."</author>\n";
            }
            /*
            // on hold
            if ($this->items[$i]->source!="") {
                    $feed.= "            <source>".htmlspecialchars($this->items[$i]->source)."</source>\n";
            }
            */
            if ($this->items[$i]->category!="") {
                $feed.= "            <category>".htmlspecialchars($this->items[$i]->category)."</category>\n";
            }
            if ($this->items[$i]->comments!="") {
                $feed.= "            <comments>".htmlspecialchars($this->items[$i]->comments)."</comments>\n";
            }
            if ($this->items[$i]->date!="") {
            $itemDate = new FeedDate($this->items[$i]->date);
                $feed.= "            <pubDate>".htmlspecialchars($itemDate->rfc822())."</pubDate>\n";
            }
            if ($this->items[$i]->guid!="") {
                $feed.= "            <guid>".htmlspecialchars($this->items[$i]->guid)."</guid>\n";
            }
            $feed.= $this->_createAdditionalElements($this->items[$i]->additionalElements, "        ");
            $feed.= "        </item>\n";
        }
        $feed.= "    </channel>\n";
        $feed.= "</rss>\n";
        return $feed;
    }
}

class RSSCreator20 extends RSSCreator091 {

    function RSSCreator20() {
        parent::_setRSSVersion("2.0");
    }   
}

class HTMLCreator extends FeedCreator {

    var $contentType = "text/html";
    
    /**
     * Contains HTML to be output at the start of the feed's html representation.
     */
    var $header;
    
    /**
     * Contains HTML to be output at the end of the feed's html representation.
     */
    var $footer ;
    
    /**
     * Contains HTML to be output between entries. A separator is only used in 
     * case of multiple entries.
     */
    var $separator;
    
    /**
     * Used to prefix the stylenames to make sure they are unique 
     * and do not clash with stylenames on the users' page.
     */
    var $stylePrefix;
    
    /**
     * Determines whether the links open in a new window or not.
     */
    var $openInNewWindow = true;
    
    var $imageAlign ="right";
    
    /**
     * In case of very simple output you may want to get rid of the style tags,
     * hence this variable.  There's no equivalent on item level, but of course you can 
     * add strings to it while iterating over the items ($this->stylelessOutput .= ...)
     * and when it is non-empty, ONLY the styleless output is printed, the rest is ignored
     * in the function createFeed().
     */
    var $stylelessOutput ="";

    /**
     * Writes the HTML.
     * @return    string    the scripts's complete text 
     */
    function createFeed() {
        // if there is styleless output, use the content of this variable and ignore the rest
        if ($this->stylelessOutput!="") {
            return $this->stylelessOutput;
        }
        
        //if no stylePrefix is set, generate it yourself depending on the script name
        if ($this->stylePrefix=="") {
            $this->stylePrefix = str_replace(".", "_", $this->_generateFilename())."_";
        }

        //set an openInNewWindow_token_to be inserted or not
        if ($this->openInNewWindow) {
            $targetInsert = " target='_blank'";
        }
        
        // use this array to put the lines in and implode later with "document.write" javascript
        $feedArray = array();
        if ($this->image!=null) {
            $imageStr = "<a href='".$this->image->link."'".$targetInsert.">".
                            "<img src='".$this->image->url."' border='0' alt='".
                            FeedCreator::iTrunc(htmlspecialchars($this->image->title),100).
                            "' align='".$this->imageAlign."' ";
            if ($this->image->width) {
                $imageStr .=" width='".$this->image->width. "' ";
            }
            if ($this->image->height) {
                $imageStr .=" height='".$this->image->height."' ";
            }
            $imageStr .="/></a>";
            $feedArray[] = $imageStr;
        }
        
        if ($this->title) {
            $feedArray[] = "<div class='".$this->stylePrefix."title'><a href='".$this->link."' ".$targetInsert." class='".$this->stylePrefix."title'>".
                FeedCreator::iTrunc(htmlspecialchars($this->title),100)."</a></div>";
        }
        if ($this->getDescription()) {
            $feedArray[] = "<div class='".$this->stylePrefix."description'>".
                str_replace("]]>", "", str_replace("<![CDATA[", "", $this->getDescription())).
                "</div>";
        }
        
        if ($this->header) {
            $feedArray[] = "<div class='".$this->stylePrefix."header'>".$this->header."</div>";
        }
        
        for ($i=0;$i<count($this->items);$i++) {
            if ($this->separator and $i > 0) {
                $feedArray[] = "<div class='".$this->stylePrefix."separator'>".$this->separator."</div>";
            }
            
            if ($this->items[$i]->title) {
                if ($this->items[$i]->link) {
                    $feedArray[] = 
                        "<div class='".$this->stylePrefix."item_title'><a href='".$this->items[$i]->link."' class='".$this->stylePrefix.
                        "item_title'".$targetInsert.">".FeedCreator::iTrunc(htmlspecialchars(strip_tags($this->items[$i]->title)),100).
                        "</a></div>";
                } else {
                    $feedArray[] = 
                        "<div class='".$this->stylePrefix."item_title'>".
                        FeedCreator::iTrunc(htmlspecialchars(strip_tags($this->items[$i]->title)),100).
                        "</div>";
                }
            }
            if ($this->items[$i]->getDescription()) {
                $feedArray[] = 
                "<div class='".$this->stylePrefix."item_description'>".
                    str_replace("]]>", "", str_replace("<![CDATA[", "", $this->items[$i]->getDescription())).
                    "</div>";
            }
        }
        if ($this->footer) {
            $feedArray[] = "<div class='".$this->stylePrefix."footer'>".$this->footer."</div>";
        }
        
        $feed= "".join($feedArray, "\r\n");
        return $feed;
    }
    
    /**
     * Overrrides parent to produce .html extensions
     *
     * @return string the feed cache filename
     * @since 1.4
     * @access private
     */
    function _generateFilename() {
        //$fileInfo = pathinfo($_SERVER["PHP_SELF"]);
        //return substr($fileInfo["basename"],0,-(strlen($fileInfo["extension"])+1)).".html";
    }
}
?>