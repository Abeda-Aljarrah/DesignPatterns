import React, { useState, useEffect } from "react";
import { DndContext, closestCenter } from "@dnd-kit/core";
import { SortableContext, useSortable, arrayMove } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import Button from "./components/Button";
import axios from "axios"; 
import Swal from "sweetalert2";


const SortableItem = ({ item }) => {
  const { attributes, listeners, setNodeRef, transform, transition } = useSortable({ id: item.id });

  const style = {
    transform: CSS.Transform.toString(transform),
    transition,
  };

  return (
    <div
      ref={setNodeRef}
      className="p-2 m-2 border border-secondary bg-light text-dark text-center rounded"
      style={style}
      {...attributes}
      {...listeners}
    >
      {item.name}
    </div>
  );
};

export default function SortingGame() {
  const [items, setItems] = useState([]);
  const [loading, setLoading] = useState(true);
  const [sortType, setSortType] = useState("alphabetical");

  // Fetch data from PHP
  useEffect(() => {
    axios.get("http://localhost/DesignPatterns/Strategy/sorting-game/backend/getData.php")
      .then(response => {
        setItems(response.data);
        setLoading(false);
      })
      .catch(error => {
        console.error("Error fetching items:", error);
        setLoading(false);
      });
  }, []);

  const handleDragEnd = (event) => {
    const { active, over } = event;
    if (active.id !== over?.id) {
      const oldIndex = items.findIndex((item) => item.id === active.id);
      const newIndex = items.findIndex((item) => item.id === over?.id);
      setItems(arrayMove(items, oldIndex, newIndex));
    }
  };

  const checkSorting = () => {
    axios.post("http://localhost/DesignPatterns/Strategy/sorting-game/backend/index.php", {
      items: items, // Send sorted items
      sortType: sortType || "alphabetical"
    })
    .then(response => {
      Swal.fire({
        title: response.data.status.includes("success") ? "Success!" : "Try Again!",
        text: response.data.message,
        icon: response.data.status.includes("success") ? "success" : "error",
        confirmButtonText: "OK"
      });
    })
    .catch(error => {
      Swal.fire({
        title: "Error",
        text: "Something went wrong while checking the sorting!",
        icon: "error",
        confirmButtonText: "OK"
      });
      console.error("Error checking sorting:", error);
    });
  };

  return (
    <div className="container text-center mt-5">
      <h1 className="fw-bold">Sorting Game</h1>

      {loading ? <p>Loading...</p> : (
        <>
          <div className="mb-3 mt-4">
            <label className="form-label fw-bold me-3">Select Sorting Type:</label>
            <select className="form-select w-auto d-inline-block" value={sortType} onChange={(e) => setSortType(e.target.value)}>
              <option value="alphabetical">Alphabetical</option>
              <option value="reverse">Reverse Alphabetical</option>
            </select>
          </div>

          <DndContext collisionDetection={closestCenter} onDragEnd={handleDragEnd}>
            <SortableContext items={items.map((item) => item.id)}>
              <div className="row justify-content-center mt-4">
                {items.map((item) => (
                  <div key={item.id} className="col-5">
                    <SortableItem item={item} />
                  </div>
                ))}
              </div>
            </SortableContext>
          </DndContext>

          <Button className="btn btn-primary mt-4" onClick={checkSorting}>
            Check Sorting
          </Button>
        </>
      )}
    </div>
  );
}
