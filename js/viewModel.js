//class to define output string
function OutputMessage (username, message, date) {
  var self=this;
  self.name=username;
  self.mesout=message;
  self.date=date;
}

function ChatViewModel () {
  var self=this;
  self.getmesdone=false;
  self.username='';
  self.mesin='';
  self.curdate = new Date();
  //calculate and convert the date
  self.curtime=self.curdate.getFullYear()
    +"-"+(self.curdate.getMonth()<10?'0'+self.curdate.getMonth():self.curdate.getMonth())
    +"-"+(self.curdate.getDate()<10?'0'+self.curdate.getDate():self.curdate.getDate())
    +" "+(self.curdate.getHours()<10?'0'+self.curdate.getHours():self.curdate.getHours())
    +":"+(self.curdate.getMinutes()<10?'0'+self.curdate.getMinutes():self.curdate.getMinutes())
    +":"+(self.curdate.getSeconds()<10?'0'+self.curdate.getSeconds():self.curdate.getSeconds());
  //array for data output
  self.mes=ko.observableArray([]);
  //add new data string
  self.SendMessage = function(name, message, time) {
    self.mes.push(new OutputMessage(name, message, time))
  };
  //"send message" button
  self.InsertMessage = function() {
    self.GetMessages();
    //set timer to know if messages are already got
    self.getmesdone=false;
    var timerId = setInterval(function() {
      if (self.getmesdone) {
        clearInterval(timerId);
        //cut spaces and check if string is empty
        if (((self.username.trim())!='')&&((self.mesin.trim())!='')) {
          $.ajax({
            url:'/php/insert.php',
            type:'POST',
            cache: false,
            data: {name:self.username, message:self.mesin},
            success: function(data) {
              if(data.indexOf('db_error') + 1) {
                alert('Отсутствует подключение к БД');
              }
              else self.SendMessage(self.username, self.mesin, self.curtime);
            }
          });
        };
      }
    }, 100);
  };
  //"get messages" button
  self.GetMessages = function() {
    $.ajax({
      url:'/php/select.php',
      type:'POST',
      cache: false,
      data: {countmes:self.mes().length},
      success: function(data) {
        if(data.indexOf('db_error') + 1) {
          alert('Отсутствует подключение к БД');
        }
        else {
          for (var i = 0; i < JSON.parse(data).length; i++) {
             self.SendMessage(JSON.parse(data)[i].username, JSON.parse(data)[i].message, JSON.parse(data)[i].date);
          };
          self.getmesdone=true;
        }
      }
    })
  };
}

ko.applyBindings(new ChatViewModel());
