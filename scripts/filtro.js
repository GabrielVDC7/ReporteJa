document.addEventListener("DOMContentLoaded", function () {
    filterSelection("all");
  
    function filterSelection(c) {
      var x = document.getElementsByClassName("status");
      if (c === "all") c = "";
      for (var i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) {
          w3AddClass(x[i], "show");
        }
      }
    }
  
    function w3AddClass(element, name) {
      var arr1 = element.className.split(" ");
      var arr2 = name.split(" ");
      for (var i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }
  
    function w3RemoveClass(element, name) {
      var arr1 = element.className.split(" ");
      var arr2 = name.split(" ");
      for (var i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }
  
    // Mostra ou esconde a linha com base na classe 'show'
    const style = document.createElement("style");
    style.innerHTML = `
      .status { display: none; }
      .status.show { display: table-row; }
    `;
    document.head.appendChild(style);
  
    // Botões de filtro
    var btnGroup = document.getElementById("btn-group");
    var btns = btnGroup.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function () {
        var current = btnGroup.getElementsByClassName("active");
        if (current.length > 0) {
          current[0].classList.remove("active");
        }
        this.classList.add("active");
  
        const status = this.textContent.trim().toLowerCase();
        switch (status) {
          case "todos": filterSelection("all"); break;
          case "pendentes": filterSelection("pendente"); break;
          case "em andamento": filterSelection("andamento"); break;
          case "concluídos": filterSelection("concluido"); break;
        }
      });
    }
  });
  