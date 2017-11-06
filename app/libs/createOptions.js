$('#registration__form_select').focus(function(){

    // Условие которое проверяется есть ли уже созданные нами optionOne и optionTwo  
    if($(this).parent().children().length == 1) {
        var optionOne = document.createElement("div");
        var optionTwo = document.createElement("div");
        optionOne.innerHTML = 'Male';
        optionOne.className = 'form__option';
        optionTwo.className = 'form__option';
        optionTwo.innerHTML = 'Female';
        optionOne.style.cssText = "width: 249px; \
                                height: 30px; \
                                background-color: white; \
                                position: relative; \
                                top: -20px; \
                                padding-left: 20px; \
                                line-height: 30px;";
        optionOne.addEventListener('mouseover', function(){
            optionColor(this);
            selectValue(this);
        })
        optionTwo.addEventListener('mouseover', function(){
            optionColor(this);
            selectValue(this);
        });
        
        optionTwo.style.cssText = optionOne.style.cssText;
        $(this).parent().append(optionOne);
        $(this).parent().append(optionTwo);
    }
});

// Удаление optionOne и optionTwo при клике в другой области
document.documentElement.addEventListener('click', function(){
    if(event.target.className != 'form__option'){
        $('#registration__form_select').parent().children().each(function(index){
            if(index == 0) {
                return true;
            }
            $(this).remove();
        });
    }
});

// Функция для создания фонового цвета для optionOne и optionTwo
function optionColor(obj){
    obj.style.background = "grey";
    obj.addEventListener('mouseout', function(){
        obj.style.background = "white";
    });
}

// Функция для проставления записи в input из optionOne или optionTwo
function selectValue(obj){
    var context = $('#registration__form_select');
    obj.addEventListener('click', function(){
        $('#registration__form_select').val(obj.innerHTML);
        deleteOption(context);
    });
}

// Функция для удаление optionOne и optionTwo
function deleteOption(context){
    context.parent().children().each(function(index){
        if(index == 0) {
            // В jQuery используется конструкция return true вместо continue
            return true;
        }
        $(this).remove();
    });
}