import XMLReq from "./XMLReq.js";
let xmlReq = new XMLReq("http://localhost/FitnessCMS-FinalProject/instructor.php");

let mname = sessionStorage.getItem("mname");
let memid = sessionStorage.getItem("memid");
let ifname = sessionStorage.getItem("fname");

class workout {
    constructor(wid, wname, mtarget, type, diff, sets, reps) {
      this.wid = wid;
      this.wname = wname;
      this.mtarget = mtarget;
      this.type = type;
      this.diff = diff;
      this.sets = sets;
      this.reps = reps;

      const addNote = document.createElement("input");
      addNote.type = "text";
      this.addNote = addNote;
  
      const addBtn = document.createElement("button");
      addBtn.innerText = "Add";
      addBtn.type = "button";
      addBtn.classList.add("btn-add");
      this.addBtn = addBtn;

      const addPress=(e)=>{
        let reqData = new FormData();
            reqData.append("mode", "add");
            reqData.append("memid", memid);
            reqData.append("mfname", mname);
            reqData.append("ifname", ifname);
            reqData.append("wid", this.wid);
            reqData.append("inote", (this.addNote).value);
            xmlReq.Post(reqData).then(
                alert("Workout added to program"),
                (rej)=>console.log(rej)
            );
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