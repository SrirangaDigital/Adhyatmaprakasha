// 
// This file shows the minimum you need to provide to BookReader to display a book
//
// Copyright(c)2008-2009 Internet Archive. Software license AGPL version 3.

// Create the BookReader object
br = new BookReader();

// Return the width of a given page.  Here we assume all images are 800 pixels wide
br.getPageWidth = function(index) {
    return 800;
}

// Return the height of a given page.  Here we assume all images are 1200 pixels high
br.getPageHeight = function(index) {
    return 1200;
}

br.getPageURI = function(index, reduce, rotate) {

	var level ;
	if(this.mode == 1)
	{
		level = reduce < 1 ? 1 : 2;
	}
	else if(this.mode == 2)
	{
		level= reduce <= 0.8 ? 1 : 2
	}
	else
	{
		level = 2;
	}
	
	
	if(level == 1)
	{
		//~  to display loading popup
		br.showProgressPopup('<img id="searchmarker" src="'+this.imagesBaseURL + 'marker_srch-on.png'+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loading...');
		$.ajax({type: "POST", url: "../templates/bgconvert.php?lang="+book.lang+"&issue="+book.issue+"&level="+level+"&index="+index+"&volume="+book.volume+"&imgurl="+book.imgurl+"&mode="+this.mode, async: true , success :function(data){br.updater(data);} , data : {book:this.book.imglist}});
		return br.imagesBaseURL + "transparent.png";
	}
	else
	{
		$.ajax({type: "POST", url: "../templates/bgconvert.php?lang="+book.lang+"&issue="+book.issue+"&level="+level+"&index="+index+"&volume="+book.volume+"&imgurl="+book.imgurl+"&mode="+this.mode, async: true , data : {book:this.book.imglist}});
		return book.imgurl+"/"+book.imglist[index]
	}
	
}
br.updater = function(result) {
	result = jQuery.parseJSON(result);
	if(result.mode == 2)
	{
		var img = document.getElementById(result.id);
		if(img != null)
		{
			img.src = result.img;
		}
	}
	else
	{
		$(result.id+" img").attr("src", result.img);
	}
	//~  to remove popup of image loading
	setTimeout(function(){
		$(br.popup).fadeOut('slow', function() {
			br.removeProgressPopup();
		})        
	},br.timeout);
}
br.getBookId = function() {
	return book.lang;
}
// Return which side, left or right, that a given page should be displayed on
br.getPageSide = function(index) {
    if (0 == (index & 0x1)) {
        return 'R';
    } else {
        return 'L';
    }
}

// This function returns the left and right indices for the user-visible
// spread that contains the given index.  The return values may be
// null if there is no facing page or the index is invalid.
br.getSpreadIndices = function(pindex) {
    var spreadIndices = [null, null]; 
    if ('rl' == this.pageProgression) {
        // Right to Left
        if (this.getPageSide(pindex) == 'R') {
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex + 1;
        } else {
            // Given index was LHS
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex - 1;
        }
    } else {
        // Left to right
        if (this.getPageSide(pindex) == 'L') {
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex + 1;
        } else {
            // Given index was RHS
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex - 1;
        }
    }
    
    return spreadIndices;
}

// For a given "accessible page index" return the page number in the book.
//
// For example, index 5 might correspond to "Page 1" if there is front matter such
// as a title page and table of contents.
br.getPageNum = function(index) {
    return index+1;
}
// Total number of leafs
br.numLeafs = book.TotalPages;
// Book title and the URL used for the book title link
br.bookTitle= book.Title;

br.bookUrl  = book.SourceURL;

// Override the path used to find UI images
br.imagesBaseURL = '../static/BookReader/images/';

br.getEmbedCode = function(frameWidth, frameHeight, viewParams) {
    return "Embed code not supported in bookreader demo.";
}

// Let's go!
br.init();

// read-aloud and search need backend compenents and are not supported in the demo
//~ $('#BRtoolbar').find('.read').hide();
//~ $('#textSrch').hide();
//~ $('#btnSrch').hide();
