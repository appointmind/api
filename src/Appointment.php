<?php
namespace Appointmind;

/**
 * 
 */
class Appointment extends Request
{
    /**
     * Crate Appointment
     * @param \DateTime $dateTime
     * @param int $calendarId
     * @param int $userId
     * @param array $data
     * @return \Appointmind\Response
     */
    public function create(\DateTime $dateTime, $calendarId, $userId, $data = [])
    {
        $frame = new \stdClass;
        $frame->jsonrpc = '2.0';
        $frame->id = "1";        
        $frame->method = 'createAppointment';
        $frame->params = new \stdClass;
        $frame->params->dateTime = $dateTime->format('Y-m-d H:i:s');
        $frame->params->calendarId = $calendarId;
        $frame->params->userId = $userId;
        $frame->params->reason = '';
        $frame->params->appointmentData = [];
        
        $this->setObject($frame);
        return $this->send();
    }
}
