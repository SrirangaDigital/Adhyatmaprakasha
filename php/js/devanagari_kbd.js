var elid;

function addtext(txtid,data)
{
	var textfield = document.getElementById(txtid);
	var old_data = document.getElementById(txtid).value;
	textfield.value =  textfield.value + data;
}

function getCaret(el) { 
  if (el.selectionStart) { 
    return el.selectionStart; 
  } else if (document.selection) { 
    el.focus(); 

    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 

    var re = el.createTextRange(), 
        rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint('EndToStart', re); 

    return rc.text.length; 
  }  
  return 0; 
}

function InsertText(data) {
	var strMiddle;
    var textarea = document.getElementById(elid);
    var currentPos = getCaret(textarea);
    var strLeft = textarea.value.substring(0,currentPos);
    strMiddle = data;		
	var strRight = textarea.value.substring(currentPos,textarea.value.length);
    textarea.value = strLeft + strMiddle + strRight;
    currentPos = currentPos+1;
	setCaretPosition(elid,currentPos)
}

function setCaretPosition(elemId, caretPos) {
    var elem = document.getElementById(elemId);

    if(elem != null) {
        if(elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if(elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}

function SetId(txtid)
{
	elid = txtid;
}
