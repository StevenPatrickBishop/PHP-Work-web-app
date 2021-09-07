var modal = document.querySelectorAll('.modal');

document.addEventListener('click', function(event){
    
     // open add set modal
    if(event.target.matches('.btn-add-set')){
        var add_new_set_modal = document.querySelector('#add-new-set-modal');
        add_new_set_modal.style.display = 'block';
    }
    
     // open edit set modal
    if(event.target.matches('.btn-edit-set')){
        for(var i = 0; i < modal.length; i++){
            var string = modal[i].className;
            var index = string.lastIndexOf(' ');
            var identifier = string.substring(index);
            //console.log(identifier);
            if(event.target.className.includes(identifier)){
                modal[i].style.display = 'block';
            }        
        }	
    }

    // open delete set modal
    if(event.target.matches('.btn-delete-set')){
        for(var i = 0; i < modal.length; i++){
            var string = modal[i].className;
            var index = string.lastIndexOf(' ');
            var identifier = string.substring(index);
            //console.log(identifier);
            if(event.target.className.includes(identifier)){
                modal[i].style.display = 'block';
            }        
        }	
    }

//close all modals
    if(event.target.matches('.close-modal')){
        for(var i = 0; i < modal.length; i++){
            modal[i].style.display = 'none';
        }
    }

});



var switch_input = document.querySelectorAll('.switch-input');
document.addEventListener('change', function(event){
    
    if(event.target.matches('.switch-mon')||
       event.target.matches('.switch-tue')||
       event.target.matches('.switch-wed')||
       event.target.matches('.switch-thr')||
       event.target.matches('.switch-fri')||
       event.target.matches('.switch-sat')){
        for(var i = 1; i <= switch_input.length; i++){
            var autoSwitch = (i*8)-2; 
            var offSwitch  =(i*8)-1;
            switch_input[autoSwitch].checked = false;
            switch_input[offSwitch].checked = false;
        }
    }


    if(event.target.matches('.switch-auto')){
        for(var i = 1; i <= switch_input.length; i++){
            var mondaySwitch =(i*8)-8;
            var tuesdaySwitch =(i*8)-7;
            var wednesdaySwitch =(i*8)-6;
            var thursdaySwitch =(i*8)-5;
            var fridaySwitch =(i*8)-4;
            var saturdaySwitch =(i*8)-3;
            var offSwitch  =(i*8)-1;

            switch_input[mondaySwitch].checked = false;
            switch_input[tuesdaySwitch].checked = false;
            switch_input[wednesdaySwitch].checked = false;
            switch_input[thursdaySwitch].checked = false;
            switch_input[fridaySwitch].checked = false;
            switch_input[saturdaySwitch].checked = false;
            switch_input[offSwitch].checked = false;
        }
    }

    if(event.target.matches('.switch-off')){
        for(var i = 1; i <= switch_input.length; i++){
            var mondaySwitch =(i*8)-8; 
            var tuesdaySwitch =(i*8)-7;
            var wednesdaySwitch =(i*8)-6;
            var thursdaySwitch =(i*8)-5;
            var fridaySwitch =(i*8)-4;
            var saturdaySwitch =(i*8)-3;
            var autoSwitch  =(i*8)-2;

            switch_input[mondaySwitch].checked = false;
            switch_input[tuesdaySwitch].checked = false;
            switch_input[wednesdaySwitch].checked = false;
            switch_input[thursdaySwitch].checked = false;
            switch_input[fridaySwitch].checked = false;
            switch_input[saturdaySwitch].checked = false;
            switch_input[autoSwitch].checked = false;
        }
    }

});