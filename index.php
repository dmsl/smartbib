<!--/*
 *
 * SmartBIB:  The SmartBIB Project allows you to present a BIB database (
 * .bibtex files) containing your publications on the web. 
 * It is ideal for personal and project websites.
 *
 * Copyright (C) 2012 Georgios Larkou - DMSL - University of Cyprus
 *
 *
 * This program is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 3 of the License, or 
 * at your option) any later version. 
 *
 * This program is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
 * GNU General Public License for more details. 
 *
 * Υou should have received a copy of the GNU General Public License 
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */-->
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>[Zeinalipour's Publications]</title>
	<script type="text/javascript" src="js/jquery.min.js"></script> 
    <!--<script type="text/javascript" src="js/jquery.isotope.min.js"></script>-->
    <script type="text/javascript" src="js/jquery.tipsy.js"></script> 
    <script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>   
    <script type="text/javascript" src="js/custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/tipsy.css"/>
    <link rel="stylesheet" type="text/css" href="css/fancybox.css"/>
</head>
<body>
	<h1><a href="http://www.cs.ucy.ac.cy/~dzeina/" target="_blank">Demetris Zeinalipour's</a> Publications</h1>
        <?php
		error_reporting(E_ALL);
	     ini_set('display_errors', '1');
			        
            /*
                Available Fields: 
                
                The field TYPE will be used for data-filtering. If it is not available then the item will be 
                marked as uncategorised.
                
                'note' 
                'abstract'
                'year'
                'group'
                'publisher'
                'location'
                'articleno'
                'numpages'
                'page-start'
                'page-end'
                'pages'
                'address'
                'url'
                'doi'
                'volume'
                'chapter'
                'journal'
                'author'
                'raw'
                'title'
                'booktitle'
                'folder'
                'type'
                'series'
                'linebegin'
                'lineend'
				'durl',
				'powerpoint',
				'infosite',
				'website'
            
            */
            
            /* 
                Define the format that will be used for printing each bibtex item.
                If a you desire to print a string infront of a field please use the following format:
                
                article = array("title", "author", "string", "bibtex field");
                
                eg.
                
                article = array("title", "author", "Num. Of pages", "pages");
                
                Please modify the example below as desired  is presented bellow. 
            */
            
            $article = array("title", "author", "journal", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $book = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $booklet = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $conference = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $inbook = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $incollection = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "chapter", "pages", "address", "isbn", "year");
            $inproceedings = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "chapter", "pages", "address", "isbn", "year");
            $manual = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $mastersthesis = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $misc = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $phdthesis = array("title", "author", "journal", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $proceedings = array("booktitle", "series", "author", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $techreport = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $unpublished = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            $other = array("title", "author", "booktitle", "series", "location", "publisher", "volume", "pages", "address", "isbn", "year");
            
            /* 
                Delimiter for Seperating each bibtex field
            */
            
            $delimiter = '.';
			
			/*
			
			Enter fields equivalent to type field in the BibTex file to sort the bibtex entries in categories. Bellow each type enter the title which will be presented as the category title.
			
			*/
			
			$sortby = array('editorial','book', 'journal', 'conference','theses', 'gconferences');
			$sortbyTitle = array('Editorials','Book Chapters', 'Journal and Magazine Papers', 'Conference and Workshop Papers', 'Theses', 'Greek Conferences');
                            
            include './bibtex/BibTex.php';				
            /* 
            
			Enter the location of your BibTex file
            
			*/
            $bibTexFile = './bibtex/demo.bib';
            
            $bibTex = new BibTeX_Parser();
            $bibTex->parser($file = $bibTexFile); 
        ?>
</body>
</html>
