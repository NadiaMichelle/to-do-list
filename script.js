
document.addEventListener("DOMContentLoaded", cargarTareas);

function cargarTareas() {
  fetch("cargar_tareas.php")
    .then(res => res.json())
    .then(data => {
      const lista = document.getElementById("lista");
      lista.innerHTML = "";
      data.forEach(tarea => {
        const li = document.createElement("li");
        li.innerHTML = `
          <span ${tarea.completada == 1 ? 'style="text-decoration:line-through;color:gray;"' : ''}>
            ${tarea.descripcion} - ${tarea.fecha_limite}
          </span>
          <button onclick="completarTarea(${tarea.id})">✔️</button>
          <button onclick="eliminarTarea(${tarea.id})">❌</button>
        `;
        lista.appendChild(li);
      });
    });
}

function agregarTarea() {
  const descripcion = document.getElementById("descripcion").value;
  const fecha = document.getElementById("fecha").value;
  if (descripcion === '' || fecha === '') return;

  fetch("agregar_tarea.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `descripcion=${encodeURIComponent(descripcion)}&fecha=${fecha}`
  }).then(() => {
    document.getElementById("descripcion").value = "";
    document.getElementById("fecha").value = "";
    cargarTareas();
  });
}

function completarTarea(id) {
  fetch(`completar_tarea.php?id=${id}`).then(() => cargarTareas());
}

function eliminarTarea(id) {
  fetch(`eliminar_tarea.php?id=${id}`).then(() => cargarTareas());
}
