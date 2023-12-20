import XMLReq from "./XMLReq.js";
let xmlReq = new XMLReq("http://localhost/php/FinalProject-Orcainstructor/instructor.php");
let wList = [];

class workout {
    constructor(wid, wname, mtarget, type, diff, sets, reps) {
      this.wid = wid;
      this.wname = wname;
      this.mtarget = mtarget;
      this.type = type;
      this.diff = diff;
      this.sets = sets;
      this.reps = reps;
  
      const addBtn = document.createElement("button");
      addBtn.innerText = "Add";
      addBtn.type = "button";
      addBtn.classList.add("btn-add");
      this.addBtn = addBtn;

      const addPress=(e)=>{
          wList.push(this.wid);
          sessionStorage.setItem("pWorkouts", wList);
          alert(`${this.wname} added`);
          e.target.parentElement.parentElement.style.display="none";
      }
      addBtn.addEventListener("click", addPress);
    }

    toRow() {
        const tr = document.createElement("tr");
        // For each property values of the product object, create a table column
        for (let prop of Object.values(this)) {
          const td = document.createElement("td");
          // If the property is an object (button), append it to the column
          // Else, take that property's value and use it as innerText for the column
          (prop instanceof Object) ? td.append(prop) : td.innerText = prop;
          // Append the columns to the product row
          tr.append(td);
        }
        return tr;
      }
};
export default workout;