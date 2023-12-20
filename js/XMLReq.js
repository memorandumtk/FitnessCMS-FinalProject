<<<<<<< HEAD
class XMLReq{
  constructor(uri){
     this.uri = uri;
  }
  
  #xmlreq(method,data=""){
     let dataPromise = new Promise((res,rej)=>{
        let xhr = new XMLHttpRequest();
        xhr.onload = ()=>{
           if(xhr.status==200){
              res(xhr.responseText);
           }else{
              rej(xhr.statusText);
           }
        }
        xhr.open(method,this.uri);
        (data!="")?xhr.send(data):xhr.send();
     })
     return dataPromise;
  }
  Post(data){
     return this.#xmlreq("POST",data);
  }
  Get(){
     return this.#xmlreq("GET");
  }
=======
class XMLReq {
    constructor (uri) {
        this.uri = uri;
    }
    xReq(method, data="") {
        let dataPromise = new Promise((res,rej)=>{
            let xhr = new XMLHttpRequest();
            xhr.onload = () => {
                if(xhr.status == 200) {
                    res(xhr.responseText);
                } else {
                    rej(xhr.statusText);
                }
            }
            xhr.open(method,this.uri);
            (data!="")?xhr.send(data):xhr.send();
        })
        return dataPromise;
    }

    Post(data) {
        return this.xReq("POST", data);
    };

    Get() {
        return this.xReq("GET");
    };
>>>>>>> ea202e9ade041dc984e8f7ea7b4c272b634de52f
}
export default XMLReq;