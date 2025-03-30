import { useEffect, useState } from "react";
import "./App.css";

// Icons
import AddBoxIcon from "@mui/icons-material/AddBox";
import DeleteIcon from "@mui/icons-material/Delete";
import EditIcon from "@mui/icons-material/Edit";

function App() {
  const [todos, setTodos] = useState([]);
  const [todo, setTodo] = useState({});

  // GET TODOS
  const fetchTodos = async () => {
    const response = await fetch("http://localhost:8000/todos", {
      method: "GET",
    });

    if (response.ok) {
      const data = await response.json();
      setTodos(data);
    }
  };

  // POST TODO
  const handleCreateTodo = async (e) => {
    e.preventDefault();
    const response = await fetch("http://localhost:8000", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(todo),
    });

    if (response.ok) {
      fetchTodos();
    }
  };

  // DELETE TODO
  const handleDeleteTodo = async (id) => {
    try {
      const response = await fetch(`http://localhost:8000/todos`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id }),
      });

      if (response.ok) {
        fetchTodos();
      } else {
        console.error("Error al eliminar la tarea");
      }
    } catch (error) {
      console.error("Error en la petición DELETE:", error);
    }
  };

  // PATCH TODO (actualización solo de completed)
  const handleUpdateTodo = async (id, completed) => {
    console.log(completed)
    const response = await fetch(`http://localhost:8000/todos`, {
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id, completed }) // Solo enviar el estado completado
    });

    if (response.ok) {
      fetchTodos();  // Refresca los todos después de la actualización
    } else {
      console.error('Error al actualizar tarea');
    }
  }

  // Cambia el estado del checkbox localmente antes de llamar a PATCH
  const handleCheckboxChange = (id, currentValue) => {
    // Llamar a handleUpdateTodo con el id y el nuevo valor de completed
    handleUpdateTodo(id, !currentValue); // Invertir el valor de completed
  };

  // Manejar cambios en el input de texto
  const handleChangeTodo = (e) => {
    e.preventDefault();
    setTodo((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  // Primer fetch al cargar el componente
  useEffect(() => {
    fetchTodos();
  }, []);

  return (
    <div className="todos-app">
      <h2>Lista de Tareas</h2>

      <form className="todo-form">
        <input
          type="text"
          name="title"
          placeholder="Agrega una nueva tarea"
          onChange={handleChangeTodo}
        />
        <button onClick={handleCreateTodo}>
          <AddBoxIcon /> Agregar tarea
        </button>
      </form>

      <div className="todos">
        {todos.length > 0 ? (
          todos.map((todo) => (
            <div key={todo.id} className="todo">
              <input
                type="checkbox"
                checked={todo.completed}
                onChange={() => handleCheckboxChange(todo.id, todo.completed)}
              />
              <h4>{todo.title}</h4>
              <div className="todo-buttons">
                <button onClick={() => handleDeleteTodo(todo.id)}>
                  <DeleteIcon />
                </button>
              </div>
            </div>
          ))
        ) : (
          <p>No hay tareas aún</p>
        )}
      </div>
    </div>
  );
}

export default App;
