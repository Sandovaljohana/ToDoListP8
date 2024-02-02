function gotodolist() {
    window.location.href = "http://localhost/Bootcamp_f5/p8ToDoList/app/Views/todolistview.php";
}

function addTask() {
    var title = document.getElementById("title").value;
    var task = document.getElementById("task").value;
    var stage = document.getElementById("stage").value;

    var query = `INSERT INTO tasks (title, task, stage) VALUES ('${title}', '${task}', ${stage})`;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../app/process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response[1]);
            updateTaskList();
        }
    };
    var formData = new FormData();
    formData.append("title", title);
    formData.append("task", task);
    formData.append("stage", stage);
    xhr.send(formData);
 }

function updateTaskList() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../../app/getTasks.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("taskList").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

window.onload = function() {
    updateTaskList();
};

