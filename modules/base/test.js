socket.on('auth', function(data){
    staff_available ++;
    var email = data.email.replace(/"/g, "").replace(/'/, "").replace('-',"");
    var password = data.password;
    var passhash = md5.digest_s(password);
    var SQL = 'SELECT * FROM chat.staff WHERE email = "'+email+'" AND passhash = "'+passhash+'"';
    client.query(SQL, function(error, results){
        if (error)
        {
            socket.emit('alert', 'Det gick inte att söka i databasen. Vänligen kontakta en administratör!');
            console.log('Error: '+error.message);
        }
        else
        {
            if (results.length > 0)
            {
                var firstResult = results[0];
                displayname = firstResult.display_name;
                authed = true;
                console.log(firstResult.display_name + ' logged in');
                staff[socket.id] = socket;
                console.log(staff[socket.id]);
                staff_ids.push(socket.id);
                broadcast_conversations();
                socket.emit('login', displayname);
                broadcast_quickreplies();
            }
            else
            {
                socket.emit('alert', 'Inloggningsuppgifterna var felaktiga!');
            }
        }
    });
});