<?php

namespace KanekiYuto\Handy\Cascade1\Constants;

/**
 * 默认的列参数
 *
 * @author KanekiTuto
 */
class DefaultColumnParams
{

    /**
     * 是否隐藏该列
     *
     * @var bool
     */
    const HIDE = true;

    /**
     * 说明
     *
     * @var string
    */
    const COMMENT = '';

    /**
     * 自增
     *
     * @var bool
     */
    const AUTO_INCREMENT = false;

    /**
     *
     * 无符号
     *
     * @var bool
     */
    const UNSIGNED = false;

    /**
     * 长度
     *
     * @var null|int
     */
    const LENGTH = null;

    /**
     * 允许将 [NULL] 值插入到该列中
     *
     * @var bool
    */
    const NULLABLE = true;

    /**
     * 主键
     *
     * @var bool
    */
    const PRIMARY = true;

    const UNIQUE = null;

}
