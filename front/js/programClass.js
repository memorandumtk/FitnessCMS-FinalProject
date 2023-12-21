import XMLReq from "./XMLReq.js";
let xmlReq = new XMLReq("http://localhost/FitnessCMS-FinalProject/instructor.php");
let pList = [];

class program {
    constructor(pid, mid, mfname, ifname, wid, inote) {
      this.pid = pid;
      this.mid = mid;
      this.mfname = mfname;
      this.ifname = ifname;
      this.wid = wid;
      this.inote = inote;
  
      const endBtn = document.createElement("button");
      endBtn.innerText = "End";
      endBtn.type = "button";
      endBtn.classList.add("btn-reject");
      this.endBtn = endBtn;

      const endPress=(e)=>{
        e.target.parentElement.parentElement.style.display = "none";
        let reqData = new FormData();
        reqData.append("mode", "end");
        reqData.append("mid", this.mid);
        reqData.append("pid", this.pid);
        xmlReq.Post(reqData).then(
            alert("Program ended"),
            (rej)=>console.log(rej)
        );
      }
      endBtn.addEventListener("click", endPress);
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
export default program;