const url = 'https://api.thinkific.com/api/public/v1/'

const thinkificHeaders = new Headers({
  'X-Auth-API-Key': '036142af339bb57d675eedf9b7953c97',
  'X-Auth-Subdomain': 'livingroomcollege',
  'Content-Type': 'application/json',
})

async function createUser(data) {
  return await fetch(`${url}/users`, {
    method: 'POST',
    headers: thinkificHeaders,
    body: JSON.stringify(data)
  })
    .then(res => res.json())
    .then(res => res.data)
}

export default {
  createUser,
}
