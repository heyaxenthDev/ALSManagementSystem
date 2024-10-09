document
  .querySelector(".post-module-btn")
  .addEventListener("click", function () {
    const formData = new FormData();
    formData.append(
      "moduleTitle",
      document.getElementById("moduleTitle").value
    );
    formData.append(
      "moduleShortDesc",
      document.getElementById("moduleShortDesc").value
    );
    formData.append(
      "uploadModuleMaterial",
      document.getElementById("uploadModuleMaterial").files[0]
    );
    formData.append(
      "moduleSelectStudentsFor",
      document.getElementById("moduleSelectStudentsFor").value
    );
    formData.append(
      "moduleTopicOption",
      document.getElementById("moduleTopicOption").value
    );
    formData.append(
      "moduleClassCode",
      document.getElementById("moduleClassCode").value
    );
    formData.append(
      "moduleTeacherCode",
      document.getElementById("moduleTeacherCode").value
    );

    fetch("submit_module_material.php", {
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
