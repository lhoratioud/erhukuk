


const radioButtons = document.getElementsByClassName("historyTab");

const radioLabels = document.getElementsByClassName("aboutus");

function radioSwitch(checkedOne)
{
    if(radioButtons[checkedOne - 1].checked)
    {
        // do nothing
    }
    else
    {

            for(var i = 0 ; i < radioLabels.length ; i++)
            {
            if(radioLabels[i].classList.contains('active'))
            {
                radioLabels[i].classList.remove('active');
            }
            }
            radioLabels[checkedOne - 1].classList.add('active');
    }
}