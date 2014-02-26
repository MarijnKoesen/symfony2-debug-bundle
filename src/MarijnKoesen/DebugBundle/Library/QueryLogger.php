<?php
namespace MarijnKoesen\DebugBundle\Library;

use Doctrine\DBAL\Logging\SQLLogger;

class QueryLogger implements SQLLogger
{
    private $runningQuery;
    private $requestId;
    private $queryLogFile;

    public function __construct($queryLogFile)
    {
        $this->queryLogFile = $queryLogFile;
    }

    /**
     * Logs a SQL statement somewhere.
     *
     * @param string     $sql    The SQL to be executed.
     * @param array|null $params The SQL parameters.
     * @param array|null $types  The SQL parameter types.
     *
     * @return void
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->runningQuery = array(
            'Type' => 'Query',
            'RequestId' => $this->getRequestId(),
            'Sql' => $sql,
            'Params' => $params,
            'Types' => $types,
            'StartTime' => microtime(true),
        );
    }

    /**
     * Marks the last started query as stopped. This can be used for timing of queries.
     *
     * @return void
     */
    public function stopQuery()
    {
        $this->runningQuery['StopTime'] = microtime(true);
        $this->runningQuery['Duration'] = $this->runningQuery['StopTime'] - $this->runningQuery['StartTime'];

        $this->writeToLog($this->runningQuery);
    }

    private function writeToLog(array $data)
    {
        // TODO use some writer interface to support stuff like Gaufrette, ActiveMQ, logstash etc
        $logfile = fopen($this->queryLogFile, 'a');
        fwrite($logfile, json_encode($data) . "\n");
        fclose($logfile);
    }

    private function getRequestId()
    {
        if (!$this->requestId) {
            $this->requestId = RequestId::getId();
        }

        return $this->requestId;
    }
}
