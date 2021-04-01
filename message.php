<?php
class Message{

	private $id;
    private $message;
    private $sender;
    private $receiver;
    private $time;
    private $status;

    /* constructor <-> destructor */

    /* I D */
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    /* M E S S A G E */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    public function getMessage()
    {
        return $this->message;
    }

    /* S E N D E R */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }
    public function getSender()
    {
        return $this->sender;
    }

    /* R E C E I V E R */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }
    public function getReceiver()
    {
        return $this->receiver;
    }

    /* T I M E */
    public function setTime($time)
    {
        $this->time = $time;
    }
    public function getTime()
    {
        return $this->time;
    }

    /* S T A T U S */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function writeMessage()
    {
    	include('database.php');
    	$this->setStatus('unread');
    	$this->setTime(date("Y-m-d h:i:sa"));
    	$query = 'INSERT INTO user_message (message, sender, receiver, correctTime , status) VALUES (:message, :sender, :receiver, :correctTime, :status)';
        $command1 = $pdo->prepare($query);
        $command1->execute([
            'message'=> $this->getMessage(),
            'sender'=> $this->getSender(),
            'receiver'=> $this->getReceiver(),
            'correctTime'=> $this->getTime(),
            'status'=> $this->getStatus()
        ]);
        return true;
	    /* D A T A B A S E destroy */
	    $pdo = null;
    }
    public function selectMessage()
    {
    	include('database.php');
        $query = "SELECT * FROM user_message WHERE 
                (sender = :sender AND receiver = :receiver) OR
                (receiver = :sender AND sender = :receiver)  ORDER BY 1 ASC";
        $command = $pdo->prepare($query);
        $command->execute([
                'sender'=>$this->getSender(),
                'receiver'=>$this->getReceiver()
                ]);

        $row = $command->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $index)
        {
        	if($index['sender'] == $_SESSION['uname'])
            {   ?> 
                <div class="text2"> <?php echo $index['message']; ?> </div> 
                <div class="text2Time"> <?php echo $index['correctTime']; ?> </div> <?php
            }
            else
            { ?> 
	            <div class="text"> <?php echo $index['message']; ?> </div> 
	            <div class="textTime"> <?php echo $index['correctTime']; ?> </div> <?php
	        }
        }
        /* D A T A B A S E destroy */
        $pdo = null; 	
    }
    
    	
}
?>