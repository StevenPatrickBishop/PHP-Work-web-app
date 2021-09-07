var modal = document.querySelectorAll('.comment_modal');
const parent = document.querySelector('.cleaning-grid-wrap');


parent.addEventListener('click', event =>{
for(var i = 0; i < modal.length; i++){
	 
	var string = modal[i].className;
	var index = string.lastIndexOf(' ');
	var identifier = string.substring(index);
	//console.log(identifier);
	
	if(event.target.className.includes(identifier)){
		modal[i].style.display = 'block';
	}
	
	if(event.target.className === 'closeBtn'){
		modal[i].style.display = 'none';
	}	
	
}	
	
});


