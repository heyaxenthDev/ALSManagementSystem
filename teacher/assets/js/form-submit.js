document.querySelector(".add-assign").addEventListener("click", function () {
  const formData = new FormData();
  formData.append("assTitle", document.getElementById("assTitle").value);
  formData.append(
    "shortDesc",
    document.getElementById("floatingShortDesc").value
  );
  formData.append(
    "uploadModule",
    document.getElementById("uploadModule").files[0]
  );
  formData.append(
    "selectStudentsFor",
    document.getElementById("selectStudentsFor").value
  );
  formData.append("topicOption", document.getElementById("topicOption").value);
  formData.append("classCode", document.getElementById("classCode").value);
  formData.append("teacherCode", document.getElementById("teacherCode").value);

  fetch("code.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
