import { useEffect, useState } from 'react'
import './App.css'

function App() {

  const [todos, setTodos] = useState([]);

  // Realizamos el primer fetch de las tareas
  useEffect(()=>{

  }, []);

  return (
    <div className='todos-app'>
     <h2>Lista de Tareas</h2>
     <form className='todo-form'>
      <input type="text" name='title' placeholder='Agrega una nueva tarea'/>
      <button> + Agregar tarea</button>
     </form>

     <div className='todos'>
      {
        todos.length > 0 ? 
          todos.map(todo => (
            <div key={todo.id}>
              <h3>{todo.title}</h3>
              <button>Editar</button>
              <button>Eliminar</button>
            </div>
          ))
        :
        <p>No hay tareas aun</p>
      }
     </div>
    </div>
  )
}

export default App
