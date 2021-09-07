
var batchGrade = document.querySelector("#grade-val");  // link to batch grade value


//program variables
var currentScore = 0;
var componentCount = -2;
//var rawMultiplier = 0.225; //.125

function rawMultiplier(componentCount){
    if(this.componentCount >= 6){
        return .3;
    }
    else{  
        return 0.225;
    }
    
}


function batchSizeMultiplier(){
    
    if(parseInt(document.querySelector("#size-input").value) <= 900 ){
        return 0.003;
    }
    else{
        return 0.0015;
    }
}


//-----------------------components section------------------------------------





// component 1----------------------------------------------------------------->

var component_1 = {
    Description:    "Monomers",
    pointValue:     0.25,
    block:          document.querySelector("#com-switch-1"),
    label:          document.querySelector("#com-switch-1 p"),
    switch_status:  "switch-off"
};
    component_1.block.addEventListener("click", function () {
    FlipSwitch(component_1);
    SetScore(component_1);
});

// component 2----------------------------------------------------------------->

var component_2 = {
    Description:    "Oligomer",
    pointValue:     0.25,
    block:          document.querySelector("#com-switch-2"),
    label:          document.querySelector("#com-switch-2 p"),
    switch_status:  "switch-off"
};
    component_2.block.addEventListener("click", function () {
    FlipSwitch(component_2);
    SetScore(component_2);
});

// component 3----------------------------------------------------------------->

var component_3 = {
    Description:    "Filler",
    pointValue:     0.50, //1.0,
    block:          document.querySelector("#com-switch-3"),
    label:          document.querySelector("#com-switch-3 p"),
    switch_status:  "switch-off"
};
    component_3.block.addEventListener("click", function () {
    FlipSwitch(component_3);
    SetScore(component_3);
});

// component 4----------------------------------------------------------------->

var component_4 = {
    Description:    "Cab/Para",
    pointValue:     1.0, //1.75,
    block:          document.querySelector("#com-switch-4"),
    label:          document.querySelector("#com-switch-4 p"),
    switch_status:  "switch-off"
};
    component_4.block.addEventListener("click", function () {
    FlipSwitch(component_4);
    SetScore(component_4);
});


// component 5----------------------------------------------------------------->

var component_5 = {
    Description:    "Thixo",
    pointValue:      2.0,//2.25,
    block:          document.querySelector("#com-switch-5"),
    label:          document.querySelector("#com-switch-5 p"),
    switch_status:  "switch-off"
};
    component_5.block.addEventListener("click", function () {
    FlipSwitch(component_5);
    SetScore(component_5);
});


// component 6----------------------------------------------------------------->
var component_6 = {
    Description:    "Perox",
    pointValue:     0.25,//0.25,
    block:          document.querySelector("#com-switch-6"),
    label:          document.querySelector("#com-switch-6 p"),
    switch_status:  "switch-off"
};
    component_6.block.addEventListener("click", function () {
    FlipSwitch(component_6);
    SetScore(component_6);
});

// component 7----------------------------------------------------------------->
var component_7 = {
    Description:    "ACRYL",
    pointValue:     0.25, //0.25,
    block:          document.querySelector("#com-switch-7"),
    label:          document.querySelector("#com-switch-7 p"),
    switch_status:  "switch-off"
};
    component_7.block.addEventListener("click", function () {
    FlipSwitch(component_7);
    SetScore(component_7);
});

// component 8----------------------------------------------------------------->
var component_8 = {
    Description:    "CND",
    pointValue:     4.0, //0.25,
    block:          document.querySelector("#com-switch-8"),
    label:          document.querySelector("#com-switch-8 p"),
    switch_status:  "switch-off"
};
    component_8.block.addEventListener("click", function () {
    FlipSwitch(component_8);
    SetScore(component_8);
});

//-----------------------Add on section------------------------------------

// Add-on 1----------------------------------------------------------------->
var addOn_1 = {
    Description:    "Drum Setup",
    pointValue:     0.25,//0.25,
    block:          document.querySelector("#addOn-switch-1"),
    label:          document.querySelector("#addOn-switch-1 p"),
    switch_status:  "switch-off"
};
    addOn_1.block.addEventListener("click", function () {
    FlipSwitch(addOn_1);
    SetScore(addOn_1);
});

// Add-on 2----------------------------------------------------------------->
var addOn_2 = {
    Description:    "Heat",
    pointValue:     0.50,//0.75,
    block:          document.querySelector("#addOn-switch-2"),
    label:          document.querySelector("#addOn-switch-2 p"),
    switch_status:  "switch-off"
};
    addOn_2.block.addEventListener("click", function () {
    FlipSwitch(addOn_2);
    SetScore(addOn_2);
});

// Add-on 3----------------------------------------------------------------->
var addOn_3 = {
    Description:    "Cool",
    pointValue:     0.50,//0.75,
    block:          document.querySelector("#addOn-switch-3"),
    label:          document.querySelector("#addOn-switch-3 p"),
    switch_status:  "switch-off"
};
    addOn_3.block.addEventListener("click", function () {
    FlipSwitch(addOn_3);
    SetScore(addOn_3);
});

// Add-on 4----------------------------------------------------------------->
var addOn_4 = {
    Description:    "Filter",
    pointValue:     0.75,//0.75,
    block:          document.querySelector("#addOn-switch-4"),
    label:          document.querySelector("#addOn-switch-4 p"),
    switch_status:  "switch-off"
};
    addOn_4.block.addEventListener("click", function () {
    FlipSwitch(addOn_4);
    SetScore(addOn_4);
});

// Add-on 5----------------------------------------------------------------->
var addOn_5 = {
    Description:    "Packout / Clean-out",
    pointValue:     0.75, //0.85,
    block:          document.querySelector("#addOn-switch-5"),
    label:          document.querySelector("#addOn-switch-5 p"),
    switch_status:  "switch-off"
};
    addOn_5.block.addEventListener("click", function () {
    FlipSwitch(addOn_5);
    SetScore(addOn_5);
});

// Add-on 6----------------------------------------------------------------->
var addOn_6 = {
    Description:    "Ross",
    pointValue:     2.0, //2.0,
    block:          document.querySelector("#addOn-switch-6"),
    label:          document.querySelector("#addOn-switch-6 p"),
    switch_status:  "switch-off"
};
    addOn_6.block.addEventListener("click", function () {
    FlipSwitch(addOn_6);
    SetScore(addOn_6);
});

// Add-on 7----------------------------------------------------------------->
var addOn_7 = {
    Description:    "Extra Handling",
    pointValue:     0.25, //1.0,
    block:          document.querySelector("#addOn-switch-7"),
    label:          document.querySelector("#addOn-switch-7 p"),
    switch_status:  "switch-off"
};
    addOn_7.block.addEventListener("click", function () {
    FlipSwitch(addOn_7);
    SetScore(addOn_7);
});

// Add-on 8----------------------------------------------------------------->
var addOn_8 = {
    Description:    "Extra Handling",
    pointValue:     1.0, //1.0,
    block:          document.querySelector("#addOn-switch-8"),
    label:          document.querySelector("#addOn-switch-8 p"),
    switch_status:  "switch-off"
};
    addOn_8.block.addEventListener("click", function () {
    FlipSwitch(addOn_8);
    SetScore(addOn_8);
});

// Raw Component---------------------------------------------------------------->
var Raws = {
    Description:    "Raws QTY",
    textBox:        document.querySelector("#qty-input"),
    pointValue:     document.querySelector("#qty-input").value,
    block:          document.querySelector("#qty-switch-1"),
    label:          document.querySelector("#qty-switch-1 p"),
    switch_status:  "switch-off"
};
    Raws.block.addEventListener("click", function () {
        
    Raws.pointValue = parseInt(document.querySelector("#qty-input").value) * rawMultiplier();
    
    if(isNaN(Raws.pointValue)){
        alert("Invalid Entry")
        Raws.pointValue = 0;
    }
    else{
        FlipSwitch(Raws);
        SetScore(Raws);
        ToggleTextBox(Raws);
    }
  
   
});


// Size component-------------------------------------------------------------->
var Size = {
    Description:    "Batch Size",
    textBox:        document.querySelector("#size-input"),
    pointValue:     document.querySelector("#size-input").value,
    block:          document.querySelector("#size-switch-1"),
    label:          document.querySelector("#size-switch-1 p"),
    switch_status:  "switch-off"
};
    Size.block.addEventListener("click", function () {
     
        Size.pointValue = parseInt(document.querySelector("#size-input").value) * batchSizeMultiplier();  
    if(isNaN(Size.pointValue)){
        alert("Invalid Entry")
        Size.pointValue = 0;
    }
    else{
        FlipSwitch(Size);
        SetScore(Size);
        ToggleTextBox(Size);
    }
             
});


//---------------------------program functions--------------------------------------
//form reset
document.querySelector(".reset-box").addEventListener("click", function() {
   
    location.reload();
});

window.addEventListener("load", function(){
    
    document.querySelector("#c1").innerHTML = component_1.pointValue.toFixed(3);
    document.querySelector("#c2").innerHTML = component_2.pointValue.toFixed(3);
    document.querySelector("#c3").innerHTML = component_3.pointValue.toFixed(3);
    document.querySelector("#c4").innerHTML = component_4.pointValue.toFixed(3);
    document.querySelector("#c5").innerHTML = component_5.pointValue.toFixed(3);
    document.querySelector("#c6").innerHTML = component_6.pointValue.toFixed(3);
    document.querySelector("#c7").innerHTML = component_7.pointValue.toFixed(3);
    document.querySelector("#c8").innerHTML = component_8.pointValue.toFixed(3);
    
    document.querySelector("#a1").innerHTML = addOn_1.pointValue.toFixed(3);
    document.querySelector("#a2").innerHTML = addOn_2.pointValue.toFixed(3);
    document.querySelector("#a3").innerHTML = addOn_3.pointValue.toFixed(3);
    document.querySelector("#a4").innerHTML = addOn_4.pointValue.toFixed(3);
    document.querySelector("#a5").innerHTML = addOn_5.pointValue.toFixed(3);
    document.querySelector("#a6").innerHTML = addOn_6.pointValue.toFixed(3);
    document.querySelector("#a7").innerHTML = addOn_7.pointValue.toFixed(3);
    document.querySelector("#a8").innerHTML = addOn_8.pointValue.toFixed(3);
    
    document.querySelector("#i1").innerHTML = Raws.pointValue.toFixed(3);
    document.querySelector("#i2").innerHTML = Size.pointValue.toFixed(3);
});

function FlipSwitch(component){
    
    //Set Status to Remove
    if (component.switch_status === "switch-off"){
        component.label.innerHTML = "Remove";
        component.block.classList = "selection-switch rotated_background";
        component.block.children[0].classList = "cross rotated";
        component.switch_status = "switch-on";
        componentCount++
        return;
    }
    //set status to Add
    if(component.switch_status === "switch-on"){
        component.label.innerHTML = "Add";
        component.block.classList = "selection-switch";
        component.block.children[0].classList = "cross";
        component.switch_status = "switch-off";
		componentCount--;
        return;
    }
}

function SetScore(component){
    if(component.switch_status === "switch-on"){
        currentScore += component.pointValue;
      	//batchGrade.innerHTML = (Math.round(currentScore * 100) /100).toFixed(2);
        batchGrade.innerHTML = (Math.floor(currentScore * 20) /20).toFixed(2);
		//batchGrade.innerHTML = currentScore.toFixed(2);
        return;
    }
     if(component.switch_status === "switch-off"){
        currentScore -= component.pointValue;
         //batchGrade.innerHTML = (Math.round(currentScore * 100) /100).toFixed(2);
         batchGrade.innerHTML = (Math.floor(currentScore * 20) /20).toFixed(2);
		 //batchGrade.innerHTML = currentScore.toFixed(2);
        return;
    }
    
}

function ToggleTextBox(component){
    
    //enable component text box
    if (component.switch_status === "switch-off"){
        component.textBox.disabled = false;
    }
    
    //disable component text box
    if(component.switch_status === "switch-on"){
        component.textBox.disabled = true;
    }
}



