function Clear(){
    document.getElementById('ans').value = '';
}

function BackSpace(){
    // var bs=document.getElementById('ans').value;
    document.getElementById('ans').value=document.getElementById('ans').value   .slice(0,-1);
}

function Dislay(val){
    var ans=document.getElementById('ans');
    ans.value+=val;
    document.getElementById('ans').value=ans.value;
}

function Result()
{
    var final=document.getElementById('ans').value;
    var answer=eval(final);
    document.getElementById('ans').value=answer;
    
}