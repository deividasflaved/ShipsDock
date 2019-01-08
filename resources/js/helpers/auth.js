import { setAuthorization } from "./general";

export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then((response) => {
                setAuthorization(response.data.access_token);
                res(response.data);
            })
            .catch((err) =>{
                rej("Neteisingas El. paštas arba slaptažodis");
            })
    })
}

export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) {
        return null;
    }

    return JSON.parse(userStr);
}
export function register(credentials){
    let error = "";
    if(credentials.name == ''){
        error = "Įveskite vardą!";
    }
    else if(credentials.email == ''){
        error = "Įveskite El. paštą!";
    }
    else if(credentials.password != credentials.password_confirmation){
        error = "Slaptažodžiai nesutampa!";
    }
    return new Promise((res, rej) =>{
        axios.post('/api/auth/register', credentials)
            .then((response) => {
                res(response.data);
            })
            .catch((err) => {
                rej(error);
            })
    })
}