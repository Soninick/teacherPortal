
document.getElementById('addStudentBtn').addEventListener('click', function() {
    document.getElementById('addStudentModal').style.display = 'block';
});

document.getElementById('addStudentForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var studentName = document.getElementById('student_name').value;
    var subject = document.getElementById('subject').value;
    var marks = document.getElementById('marks').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_student.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) { 
            location.reload();
        }
    };
    xhr.send('student_name=' + encodeURIComponent(studentName) + '&subject=' + encodeURIComponent(subject) + '&marks=' + encodeURIComponent(marks));
});
