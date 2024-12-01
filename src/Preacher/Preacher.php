<?php

namespace KanekiYuto\Handy\Preacher;

use Closure;

/**
 * Preacher
 *
 * @author KanekiYuto
 */
class Preacher
{
    
    /**
     * 成功状态响应码
     *
     * @var int
     */
    const RESP_CODE_SUCCEED = 200;
    
    /**
     * 警告状态响应码
     *
     * @var int
     */
    const RESP_CODE_WARN = 400;
    
    /**
     * 失败状态响应码
     *
     * @var int
     */
    const RESP_CODE_FAIL = 500;
    
    /**
     * 鉴权状态响应码
     *
     * @var int
     */
    const RESP_CODE_AUTH = 401;
    
    /**
     * 访问被拒绝响应码
     *
     * @var int
     */
    const RESP_CODE_ACCESS_DENIED = 403;
    
    /**
     * 默认状态码键名称
     *
     * @var string
     */
    const DEFAULT_KEY_CODE = 'code';
    
    /**
     * 默认消息键名称
     *
     * @var string
     */
    const DEFAULT_KEY_MSG = 'msg';
    
    /**
     * 默认的 [json] 选项
     *
     * @var int
     */
    const DEFAULT_JSON_OPTIONS = JSON_PARTIAL_OUTPUT_ON_ERROR;
    
    /**
     * 默认的 [HTTP] 状态码
     *
     * @var int
     */
    const DEFAULT_HTTP_STATUS = 200;
    
    /**
     * 消息的生命周期
     *
     * @var Closure
     */
    private static Closure $messageActivity;
    
    /**
     * 状态码
     *
     * @var int
     */
    private int $code;
    
    /**
     * 响应消息
     *
     * @var string
     */
    private string $msg;
    
    /**
     * 响应数据
     *
     * @var array
     */
    private array $data;
    
    /**
     * 使用消息生命周期
     *
     * @param  Closure  $closure
     */
    public static function useMessageActivity(Closure $closure): void
    {
        static::$messageActivity = $closure;
    }
    
    /**
     * 验证并返回预设
     *
     * @param  bool  $allow
     * @param  self  $pass
     * @param  self  $noPass
     * @param  callable|null  $handle
     *
     * @return self
     */
    public static function allow(
        bool $allow,
        mixed $pass,
        mixed $noPass,
        callable $handle = null,
    ): mixed {
        if (!empty($handle)) {
            call_user_func($handle);
        }
        
        return $allow ? $pass : $noPass;
    }
    
    /**
     * 返回基础的默认信息
     *
     * @return self
     */
    public static function base(): self
    {
        return new self();
    }
    
    /**
     * 等同于 [setMsg()]
     *
     * @param  string  $msg
     *
     * @return self
     */
    public static function msg(
        string $msg
    ): self {
        return (new self())->setMsg($msg);
    }
    
    /**
     * 等同于 [setCode()]
     *
     * @param  int  $code
     *
     * @return Preacher
     */
    public static function code(
        int $code
    ): self {
        return (new self())->setCode($code);
    }
    
    /**
     * 同时设置 [msg] 和 [code]
     *
     * @param  int  $code
     * @param  string  $msg
     *
     * @return Preacher
     */
    public static function msgCode(
        int $code,
        string $msg
    ): self {
        return (new self())->setCode(
            $code
        )->setMsg($msg);
    }
    
    /**
     * 等同于 [setPaging]
     *
     * @param  int  $page
     * @param  int  $prePage
     * @param  int  $total
     * @param  array  $data
     *
     * @return self
     */
    public static function paging(
        int $page,
        int $prePage,
        int $total,
        array $data
    ): self {
        return (new self())->setPaging(
            $page,
            $prePage,
            $total,
            $data
        );
    }
    
    /**
     * 等同于 [setReceipt]
     *
     * @param  object  $data
     *
     * @return self
     */
    public static function receipt(object $data): self
    {
        return (new self())->setReceipt($data);
    }
    
    /**
     * 等同于 [setRows]
     *
     * @param  array  $data
     *
     * @return Preacher
     */
    public static function rows(array $data): self
    {
        return (new self())->setRows($data);
    }
    
    /**
     * 构造一个 [Preacher] 实例
     *
     * @param  int  $code
     * @param  string  $msg
     */
    private function __construct(
        int $code = self::RESP_CODE_SUCCEED,
        string $msg = ''
    ) {
        $this->code = $code;
        $this->msg = $msg;
        $this->data = [];
    }
    
    /**
     * 设置响应状态码
     *
     * @param  int  $code
     *
     * @return self
     */
    public function setCode(int $code): self
    {
        $this->code = $code;
        
        return $this;
    }
    
    /**
     * 获取响应状态码
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
    
    /**
     * 设置响应消息
     *
     * @param  string  $msg
     *
     * @return self
     */
    public function setMsg(string $msg): self
    {
        $messageActivity = static::$messageActivity;
        $this->msg = $messageActivity($msg);
        
        return $this;
    }
    
    /**
     * 获取响应消息
     *
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }
    
    
    /**
     * 设置分页信息
     *
     * @param  int  $page
     * @param  int  $prePage
     * @param  int  $total
     * @param  array  $data
     *
     * @return self
     */
    public function setPaging(
        int $page,
        int $prePage,
        int $total,
        array $data
    ): self {
        $this->data['paging'] = (object) [
            'page'    => $page,
            'prePage' => $prePage,
            'total'   => $total,
            'rows'    => $data,
        ];
        
        return $this;
    }
    
    /**
     * 获取分页信息
     *
     * @return object
     */
    public function getPaging(): object
    {
        return $this->data['paging'];
    }
    
    /**
     * 设置回执信息
     *
     * @param  object  $data
     *
     * @return static
     */
    public function setReceipt(object $data): static
    {
        $this->data['receipt'] = $data;
        
        return $this;
    }
    
    /**
     * 返回回执信息
     *
     * @return object
     */
    public function getReceipt(): object
    {
        return $this->data['receipt'];
    }
    
    /**
     * 设置行数据
     *
     * @param  array  $data
     *
     * @return static
     */
    public function setRows(array $data): static
    {
        $this->data['rows'] = $data;
        
        return $this;
    }
    
    /**
     * 获取行数据
     *
     * @return array
     */
    public function getRows(): array
    {
        return $this->data['rows'];
    }
    
    /**
     * 判断是否成功
     *
     * @return bool
     */
    public function isSucceed(): bool
    {
        return $this->code === self::RESP_CODE_SUCCEED;
    }
    
    /**
     * 导出响应
     *
     * @return Export
     */
    public function export(): Export
    {
        return new Export(array_merge([
            self::DEFAULT_KEY_CODE => $this->getCode(),
            self::DEFAULT_KEY_MSG  => $this->getMsg(),
        ], $this->data));
    }
    
}