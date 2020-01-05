function ID(id){
    return document.getElementById(id);
}
var list_id = ID('list');


function createMainList(id, i) {
    var li = document.createElement("li");
    var a = document.createElement("a");
    var ul = document.createElement("ul");
    ul.setAttribute("style","display:none;");
    ul.setAttribute("id",i);
    ul.setAttribute("class","sub_list");

    a.setAttribute("href","#");
    a.setAttribute("class","link");
    a.setAttribute("onclick","Show("+i+")");
    a.appendChild(document.createTextNode("Test"));

    li.setAttribute("class", "list");
    li.appendChild(a);
    li.appendChild(ul)
    ID(id).appendChild(li);
}
function createNestedList(id) {
    var li = document.createElement("li");
    var a = document.createElement("a");
    a.appendChild(document.createTextNode("test2"));
    a.setAttribute("href","#");
    a.setAttribute("onclick","readBook('hey')");
    li.appendChild(a);
    ID(id).appendChild(li);
}

function  Show(id) {
    if(ID(id).style.display === "none") {
        ID(id).style.display = "block";
    } else {
        ID(id).style.display = "none";
    }
}

function hideIframe() {
    ID("iframe").style.display = "none";
}

function readBook(src){

    ID("IFRAME").src = src;
    ID("iframe").style.display = "block";

}

function bookForm(con) {
    if (con === "none") {
        ID("book_form").style.display = "none";
    } else {
        ID("book_form").style.display = "block";
    }
}
