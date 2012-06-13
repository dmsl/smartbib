<?php
/**
 * BibTex Parser 
 */
class BibTeX_Parser
{
    var $count;
    var $items;
	var $sortedItems;
    var $types;
    var $filename;
    var $inputdata;
	var $yearData;
	var $lastType;
    
    /**
     * BibTeX_Parser( $file, $data )
     *
     * Constructor
     * @param String $file if filename is used
     * @param String $data if input is a string
     */
    function parser( $file = null, $data = null ) {
        $this->items = array(
            'note' => array(),
            'abstract' => array(),
            'year' => array(),
            'group' => array(),
            'publisher' => array(),
			'location' => array(),
			'articleno' => array(),
			'numpages' => array(),
			'doi' => array(),
			'page-start' => array(),
			'page-end' => array(),
            'pages' => array(),
            'address' => array(),
            'url' => array(),
            'volume' => array(),
            'chapter' => array(),
            'journal' => array(),
            'author' => array(),
            'raw' => array(),
            'title' => array(),
            'booktitle' => array(),
            'folder' => array(),
            'type' => array(),
			'series' => array(),
            'linebegin' => array(),
            'lineend' => array(),
			'durl' => array(),
			'powerpoint' => array(),
        );
        
        if( $file )
            $this->filename = $file;
        elseif( $data )
            $this->inputdata = $data;
        
        // Oh, what the heck!
        $this->parse();
		
		global $sortby;
		//$this->sortedItems = $this->sort_by($this -> items, $sortby, 'type');
		$this->sortedItems = @$this->array_multisort_by_order($this->items, 'type', $sortby);
		
		return $this->printPublications();
    }

    /**
     * parse()
     *
     * Main method that parses the data.
     */
    function parse() {
        $value = array();
        $var = array();
        $this->count = -1;
        $lineindex = 0;
        $fieldcount = -1;
        if( $this->filename )
            $lines = file($this->filename);
        else
            $lines = preg_split( '/\n/', $this->inputdata );
    
        if (!$lines)
            return;
    
        foreach($lines as $line) {
            $lineindex++;
            $this->items['lineend'][$this->count] = $lineindex;
            $line = trim($line);
            $raw_line = $line + '\n';
            $line=str_replace("'","`",$line);
            $seg=str_replace("\"","`",$line);
            $ps=strpos($seg,'=');
            $segtest=strtolower($seg);
    
            // some funny comment string
            if (strpos($segtest,'@string')!==false)
                continue;
    
            // pybliographer comments
            if (strpos($segtest,'@comment')!==false)
                continue;
    
            // normal TeX style comment
            if (strpos($seg,'%%')!==false)
                continue;
    
            /* ok when there is nothing to see, skip it! */
            if (!strlen($seg))
                continue;
    
            if ("@" == $seg[0]) {
                $this->count++;
                $this->items['raw'][$this->count] = $line . "\r\n";
                
                $ps=strpos($seg,'@');
                $pe=strpos($seg,'{');
                $this->types[$this->count]=trim(substr($seg, 1,$pe-1));
                $fieldcount=-1;
                $this->items['linebegin'][$this->count] = $lineindex;
            } // #of item increase
            elseif ($ps!==false ) { // one field begins
                $this->items['raw'][$this->count] .= $line . "\r\n";
                $ps=strpos($seg,'=');
                $fieldcount++;
                $var[$fieldcount]=strtolower(trim(substr($seg,0,$ps)));
    
                if ($var[$fieldcount]=='pages') {
                    $ps=strpos($seg,'=');
                    $pm=strpos($seg,'--');
                    $pe=strpos($seg,'},');
                    $pagefrom[$this->count] = substr($seg,$ps,$pm-$ps);
                    $pageto[$this->count]=substr($seg,$pm,$pe-$pm);
                    $bp=str_replace('=','',$pagefrom[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);$bp=trim(str_replace('-','',$bp));
                    $ep=str_replace('=','',$pageto[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);;$ep=trim(str_replace('-','',$ep));
                }
                $pe=strpos($seg,'},');
                
                if ($pe===false)
                    $value[$fieldcount]=strstr($seg,'=');
                else
                    $value[$fieldcount]=substr($seg,$ps,$pe);
            } else {
                $this->items['raw'][$this->count] .= $line . "\r\n";
                $pe=strpos($seg,'},');
                
                if ($fieldcount > -1) {
                    if ($pe===false)
                        $value[$fieldcount].=' '.strstr($seg,' ');
                    else
                        $value[$fieldcount] .=' '.substr($seg,$ps,$pe);
                }
            }
            
            if ($fieldcount > -1) {
                $v = $value[$fieldcount];
                $v=str_replace('=','',$v);
                $v=str_replace('{','',$v);
                $v=str_replace('}','',$v);
                $v=str_replace(',',' ',$v);
                $v=str_replace('\'',' ',$v);
                $v=str_replace('\"',' ',$v);
                // test!
                $v=str_replace('`',' ',$v);
                $v=trim($v);
                $this->items["$var[$fieldcount]"][$this->count]="$v";
            }
        }
    }
	
	function printPublications() {
		global $article;
		global $book;
		global $booklet;
		global $conference;
		global $inbook;
		global $inproceedings;
		global $incollection;
		global $inbook;
		global $mastersthesis;
		global $misc;
		global $phdthesis;
		global $proceedings;
		global $techreport;
		global $unpublished;
		global $other;
		for ($i = 0; $i <= $this->count; $i++ ) {
			switch ($this->types[$i]) {
				case "article":
					$this->htmlPublication("article", $article, $i);
					break;
				case "book":
					$this->htmlPublication("book", $book, $i);
					break;
				case "booklet":
					$this->htmlPublication("booklet", $article, $i);
					break;
				case "conference":
					$this->htmlPublication("conference", $conference, $i);
					break;
				case "inbook":
					$this->htmlPublication("inbook", $inbook, $i);
					break;
				case "incollection":
					$this->htmlPublication("incollection", $incollection, $i);
					break;
				case "inproceedings":
					$this->htmlPublication("inproceedings", $inproceedings, $i);
					break;
				case "manual":
					$this->htmlPublication("inbook", $manual, $i);
					break;
				case "mastersthesis":
					$this->htmlPublication("mastersthesis", $matersthesis, $i);
					break;
				case "misc":
					$this->htmlPublication("misc", $misc, $i);
					break;
				case "phdthesis":
					$this->htmlPublication("phdthesis", $phdthesis, $i);
					break;
				case "proceedings":
					$this->htmlPublication("proceedings", $proceedings, $i);
					break;
				case "techreport":
					$this->htmlPublication("techreport", $techreport, $i);
					break;
				case "unpublished":
					$this->htmlPublication("unpublished", $unpublished, $i);
					break;
				default:
					$this->htmlPublication("other", $other, $i);
				
			}
		}
	}
	
	function htmlPublication($type, $fields, $element) {
		global $delimiter; 
		global $sortbyTitle;
		if ($this->lastType != $this->sortedItems['type'][$element]){
			$this->lastType = $this->sortedItems['type'][$element];
			echo '<li class="category-title">'.$this->getTitle($this->sortedItems['type'][$element]).'</li>';
		}
		echo '<li class="'.$this->sortedItems['year'][$element].'" title="'.$this->sortedItems['year'][$element].'">';        
		$this->countTypes($element, $this->sortedItems['type'][$element]);         
		foreach($fields as $print) {
			if(isset($this->sortedItems[$print])){
				if(isset($this->sortedItems[$print][$element])){
					switch ($print) {
						case "title":
							echo '<strong>';
							if(isset($this->sortedItems['durl'][$element])){ 
								echo '<a href="'.$this->sortedItems['durl'][$element].'">';
							} 
							echo $this->sortedItems[$print][$element];
							if (isset($this->sortedItems['durl'][$element])) {
								echo '</a>';
							}
							echo '</strong>'.$delimiter.' ';
							break;
						case "year":
							echo "<strong>".$this->sortedItems[$print][$element]."</strong>".$delimiter." ";
							break;
						case "numpages":
							echo $this->sortedItems[$print][$element]." pages";
						case "pages":
							echo " Pages: ".$this->sortedItems[$print][$element].". ";
							break;
						case "series":
							echo "(".$this->sortedItems[$print][$element].")";
							break;
						case "isbn":
							echo " ISBN ".$this->sortedItems[$print][$element].". ";
							break;
						case "volume":
							echo " Volume ".$this->sortedItems[$print][$element].". ";
							break;
						default:
							echo $this->sortedItems[$print][$element].$delimiter." ";
					}
				}
			}
			else {
				echo $print;	
			}
		}
		if (isset($this->sortedItems['raw'][$element])) {
			echo '<a href="#bibtex-'.$element.'" class="publications-bib" title="BibTex" id="publink-'.$element.'" href="#" title="BibTex Reference"></a>';
			echo '<div id="bibtex-wrapper" style="display:none;"><div id="bibtex-'.$element.'" style="width:700px;"><pre>'.$this->sortedItems['raw'][$element].'</pre></div></div>';
		}
		if (isset($this->sortedItems['durl'][$element])) {
			echo '<a href="#download-'.$element.'" class="publications-pdf" id="publink-'.$element.'" href="#" title="Download PDF"></a>';
			echo '<div id="pdf-wrapper" style="display:none;"><div id="download-'.$element.'"><embed src="'.$this->sortedItems['durl'][$element].'"  type="application/pdf" width="840" height="680" /></div></div>';
		}
		if (isset($this->sortedItems['powerpoint'][$element])) {
			echo '<a href="'.$this->sortedItems['powerpoint'][$element].'" class="publications-ppt" id="publink-'.$element.'" href="#" title="Presentation" target="_blank"></a>';
			echo '<div id="ppt-wrapper" style="display:none;"><div id="powerpoint-'.$element.'"><embed src="'.$this->sortedItems['powerpoint'][$element].'"  type="application/ppt" width="840" height="680" /></div></div>';
		}
		echo '</li>';
	}
	
	function countTypes($iterator, $type) {
		$previous = array_slice($this->sortedItems['type'], 0, $iterator + 1, true);
        $counts = array_count_values($previous);
		$all = array_count_values($this->sortedItems['type']);
		
		$number = $all[$type] - $counts[$type] + 1;
		if($type == 'book') {
			echo "<strong>[BC".$number."]</strong> ";

		}
		else {
			echo "<strong>[".ucfirst(substr($type, 0, 1))."".$number."]</strong> ";
		}
	}
	function sort_by($arr, $sub, $order){
		// Create a map from old key to new key
		$value_kmap = array_flip($arr[$sub]);
		$sort_kmap = array_flip($order);
		foreach($order as $value)
			$kmap[$value_kmap[$value]] = $sort_kmap[$value];
	
		// Create your result array
		foreach($arr as $name => $sub_arr)
			foreach($kmap as $key => $new_key)
				if(isset($sub_arr[$key]))
					$result[$name][$new_key] = $sub_arr[$key];
	
		return $result;
	}
	/**
	 * @param array $array
	 * @param string|int $by key/offset
	 * @param array $order
	 * @return array
	 */
	function array_multisort_by_order(array $array, $by, array $order)
	{
		$order = array_flip($order);
		$sort = $array[$by];
		foreach($sort as &$v) $v = $order[$v];
		$params[] = &$sort;
		foreach($array as &$v) $params[] =&$v; unset($v);
		call_user_func_array('array_multisort', $params);
		return $array;
	}
	
	function getTitle ($type) {
		global $sortby;
		global $sortbyTitle;
		
		$array_size = count($sortby);
		for($i = 0; $i < $array_size; $i++)
		{
			if( $sortby[$i] == $type){
				return $sortbyTitle[$i];
			}
		}
		
	}
}
?>