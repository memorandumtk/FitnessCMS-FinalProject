import XMLReq from "./XMLReq.js";
let xmlReq = new XMLReq("http://localhost/FitnessCMS-FinalProject/instructor.php");

class request {
    constructor(rid, mid, mfname, mlname, dlevel, dpw, instructor, goal, notes) {
      this.rid = rid;
      this.mid = mid;
      this.mfname = mfname;
      this.mlname = mlname;
      this.dlevel = dlevel;
      this.dpw = dpw;
      this.instructor = instructor;
      this.goal = goal;
      this.notes = notes;
  
      const aBtn = document.createElement("button");
      aBtn.innerText = "Accept";
      aBtn.type = "button";
      aBtn.classList.add("btn-accept");
      this.aBtn = aBtn;
  
      const rBtn = document.createElement("button");
      rBtn.innerText = "Reject";
      rBtn.type = "button";
      rBtn.classList.add("btn-reject");
      this.rBtn = rBtn;


      const acceptPress=(e)=>{
        sessionStorage.setItem("memid", this.mid);
        sessionStorage.setItem("mname", this.mfname);
        e.target.parentElement.parentElement.style.display = "none";
        location.replace("./createprogram.html");
      };
      aBtn.addEventListener("click", acceptPress);

      const rejectPress=(e)=>{
        e.target.parentElement.parentElement.style.display = "none";
        let reqData = new FormData();
        reqData.append("mode", "reject");
        reqData.append("mid", this.mid);
        xmlReq.Post(reqData).then(
            alert("Request rejected"),
            // console.log(this.mid),
            (rej)=>console.log(rej)
        );
      }
      rBtn.addEventListener("click", rejectPress);
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
export default request;