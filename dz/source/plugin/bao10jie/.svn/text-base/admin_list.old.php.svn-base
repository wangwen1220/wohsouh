<?php

/*
 * 帖子净化插件——后台审核
 */

if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');

############################
#更改帖子状态的处理
############################
if ($pids) {
    #帖子的URL地址
    $port = $_SERVER['SERVER_PORT'] == 80 ? '' : ':' . $_SERVER['SERVER_PORT'];
    $turl = 'http://';
    $turl .= $_SERVER['SERVER_NAME'];
    $turl .= $port . rtrim(dirname($_SERVER['REQUEST_URI']), "/\\");
    $turl .= '/viewthread.php?tid=';

    foreach ($pids as $pid) {
        $postData = array();
        $pid = abs(intval($pid)); #帖子ID
        if ($thepid && $thepid != $pid)
            continue;#当单条处理时，从遍历中取出单条的ID，进行反馈与改变状态

        $sig = abs(intval($_POST['sig' . $pid])); #标引：0 1 2 3 
        $sts = abs(intval($_POST['sts' . $pid])); #处理动作  0 1 2 3 
        $first = abs(intval($_POST['first' . $pid])); #是否为主帖
        $tid = abs(intval($_POST['threadid' . $pid])); #主帖ID
        $fid = abs(intval($_POST['class' . $pid])); #版块ID
        $author = $_POST['author' . $pid]; #user name

        if ($thepid) {
            $sts = $thests;
            $pid = $thepid;
        }
        if (!$sts) {#设置帖子的已确认状态，不做其它任何处理
            //$db->query("UPDATE {$tablepre}purifyhylanda SET isignore=1 WHERE pid={$pid}");
            continue;
        }
        if ($sts == 3) {#设置帖子的忽略状态，不做其它任何处理
            $db->query("UPDATE {$tablepre}purifyhylanda SET isignore=2 WHERE pid={$pid}");
            continue;
        }

        #设置帖子的状态
        $displayorder = $invisible = $status = 0;
        if (1 == $sts) {#通过
            $displayorder = 0;
            $invisible = 0;
            $status = 0;
        } elseif (2 == $sts) {#删除
            $displayorder = -1; #主帖，忽略状态（即前台不显示状态）
            if ('status' == $Purify_PURIFY_FIELD)
                $status = 1;#主帖或回帖，屏蔽状态（即前台显示‘已被删除状态’）
            else
                $invisible = -1;#回帖，忽略状态（即前台不显示状态）
        }

        #更新主贴表中标识垃圾的字段
        if (1 == $first) {
            $db->query("UPDATE {$tablepre}threads SET `lastposter`='{$author}', `lastpost`='" . time() . "', `displayorder`='{$displayorder}' WHERE tid={$tid}");
        }

        #更新帖子表中标识垃圾的字段,进行恢复操作时将两字段都弄成0,进行删除时仅对配置的字段更改成对应的值
        $db->query("UPDATE {$tablepre}posts SET status={$status}, invisible={$invisible} WHERE pid={$pid}");

        #更新用户的发帖数与积分
        if ($db->affected_rows()) {
            $adder = '';
            $act = 'reply';
            if ($first)
                $act = 'post';
            $oldStatus = abs(intval($_POST['isit' . $pid]));

            if ($oldStatus > 1 && $sts == 1) {#
                $adder = '+';
            } elseif ($oldStatus == 1 && $sts == 2) {#
                $adder = '-';
            }

            if ($adder != '' && $creditspolicy[$act])
                updatepostcredits($adder, $_POST['userid' . $pid], $creditspolicy[$act]);
        }

        #将帖子的是否处理过的状态设置为‘已人工处理’
        $db->query("UPDATE {$tablepre}purifyhylanda SET isignore=1 WHERE pid={$pid}");

        #更新版块帖子数，更新主题回帖数、最新帖子。今天的帖子总数暂时不做更新
        if ($fid)
            updateforumcount($fid);
        if ($tid)
            updatethreadcount($tid);

        #当帖子标引的状态与处理的动作不一致时，就提交反馈，否则只改变状态
        if ($sts && $sig != 128 && $sts != $sig) {
            $postData['pid'] = $pid;
            $postData['tid'] = intval($_POST['threadid' . $pid]);
            $postData['status'] = $sts;
            $postData['url'] = $turl . $tid;
            $postData['title'] = $_POST['title' . $pid];
            $postData['message'] = stripslashes($_POST['text' . $pid]);
            $postData['author'] = $_POST['author' . $pid];
            $postData['userid'] = $_POST['userid' . $pid];
            $postData['fid'] = $_POST['class' . $pid];
            $postData['ip'] = $_POST['ip' . $pid];
            $postData['date'] = $_POST['date' . $pid];
            $postData['reason'] = strip_tags($_POST['reasons' . $pid]);
            
            $update = 0; #是否反馈成功
            //调用反馈接口
            $HL_Purify->feedback($postData);
        }

        #发送操作理由，当忽略的时候不用发送操作理由
        $pm = array();
        if ($_POST['reasons' . $pid] != '' && $_POST['author' . $pid]) {
            $pm['action'] = 'modthreads_validate';
            $pm['authorid'] = intval($_POST['userid' . $pid]);
            $pm['tid'] = intval($_POST['threadid' . $pid]);
            $pm['thread'] = $_POST['tsubject' . $pid];
            $pm['reason'] = dhtmlspecialchars($_POST['reasons' . $pid]);
            if ($sts == 2)
                $pm['action'] = 'modthreads_delete';
            $reason = $pm['reason'];
            $post = $pm['post'];
            $tid = $pm['tid'];

            if (floatval(DISCUZ_VERSION) <= 7.0) {
                sendpm($pm['authorid'], $pm['action'] . '_subject', $pm['action'] . '_message', 0);
            } else {
                sendnotice($pm['authorid'], $pm['action'], 'systempm');
            }
        }
    }
}


############################
#以下为列出帖子的处理
############################
#初始化参数
if (!$pn)
    $pn = 20;
if (!$pg)
    $pg = 1;
if (!$it) {
    if (!$selTime)
        $selTime = 24;
    if (!$selState)
        $selState = 3;
    if (!$selDoer)
        $selDoer = 1;
}

$url = "admincp.php?action=plugins&operation=config&do=15&identifier=bao10jie&mod=admin_feedback&sel_page={$pn}&it={$it}";

#开始构造SQL语句
$sql = "SELECT p.`pid`,p.`tid`,p.`fid`,p.`author`,p.`authorid`,p.`subject`,p.`message`,
p.`useip`,p.`dateline`,p.`first`,p.`fid`,p.`status`,p.`invisible`,p.attachment,
p.htmlon,p.smileyoff,p.bbcodeoff,m.name AS forumname,m.allowsmilies,m.allowhtml,
m.allowbbcode,m.allowimgcode,t.subject AS tsubject,f.`sig` AS sig, t.`displayorder`, f.`isignore`, f.`sendtime`    
FROM `{$tablepre}purifyhylanda` f 
INNER JOIN `{$tablepre}posts` p ON f.`pid`=p.`pid` 
INNER JOIN `{$tablepre}threads` t ON t.`tid`=p.`tid` 
INNER JOIN `{$tablepre}forums` m ON m.`fid`=p.`fid`  
WHERE 1";

#查询总数的SQL语句
$sql_cnt = "SELECT count(*) as cnt 
FROM `{$tablepre}purifyhylanda` f
INNER JOIN `{$tablepre}posts` p ON p.`pid`=f.`pid` 
WHERE 1";

if ($selFtime || $selTtime) {
    if ($selFtime) {
        $sql .= " AND p.`dateline`>='" . strtotime($selFtime) . "'";
        $sql_cnt .= " AND p.`dateline`>='" . strtotime($selFtime) . "'";
        $url .= '&sel_ftime=' . $selFtime;
    }
    if ($selTtime) {
        $selTtime = strtotime($selTtime) + 86400 - 1;
        $sql .= " AND p.`dateline`<=" . $selTtime;
        $sql_cnt .= " AND p.`dateline`<=" . $selTtime;
        $selTtime = date('Y-m-d', $selTtime);
        $url .= '&sel_ttime=' . $selTtime;
    }
} else {
    $sql .= " AND f.`sendtime`>='" . ($_SERVER['REQUEST_TIME'] - $selTime * 3600) . "'";
    $sql_cnt .= " AND f.`sendtime`>='" . ($_SERVER['REQUEST_TIME'] - $selTime * 3600) . "'";
    $url .= '&sel_time=' . $selTime;
}

if ($selWord != '') {
    $selWords = stripslashes($selWord);
    $selWord = mysql_escape_string($selWord);
    $selWord = str_replace(array('%', '_'), array('\%', '\_'), $selWord);
    $sql .= " AND (p.`message` like '%{$selWord}%' or p.`subject` like '%{$selWord}%')";
    $sql_cnt .= " AND (p.`message` like '%{$selWord}%' or p.`subject` like '%{$selWord}%')";
    $selWord = $selWords;
    $url .= '&sel_word=' . $selWord;
}
if ($selAuthor != '') {
    $selAuthors = stripslashes($selAuthor);
    $selAuthor = mysql_escape_string($selAuthor);
    $sql .= " AND p.`author`='{$selAuthor}'";
    $sql_cnt .= " AND p.`author`='{$selAuthor}'";
    $selAuthor = $selAuthors;
    $url .= '&sel_author=' . $selAuthor;
}
if ($selPid > 0) {
    $sql .= " AND p.`pid`={$selPid}";
    $sql_cnt .= " AND p.`pid`={$selPid}";
    $url .= '&sel_pid=' . $selPid;
}
if ($selIp != '') {
    $selIps = stripslashes($selIp);
    $selIp = mysql_escape_string($selIp);
    $sql .= " AND p.`useip` like '%{$selIp}%'";
    $sql_cnt .= " AND p.`useip` like '%{$selIp}%'";
    $selIp = $selIps;
    $url .= '&sel_ip=' . $selIp;
}
if ($selBoard > 0) {
    $sql .= ' AND p.`fid`=' . $selBoard;
    $sql_cnt .= ' AND p.`fid`=' . $selBoard;
    $url .= '&sel_board=' . $selBoard;
}
if ($selMode > 0) {
    if ($selMode == 4) {
        $sql .= " AND f.`sig`=-1";
        $sql_cnt .= " AND f.`sig`=-1";
    } else {
        $sql .= " AND f.`sig`=" . ($selMode - 1);
        $sql_cnt .= " AND f.`sig`=" . ($selMode - 1);
    }
    $url .= '&sel_mode=' . $selMode;
}
if ($selState > 0) {
    if ($selState == 1) {#通过
        $sql .= " AND p.`status`=0 AND p.`invisible`=0";
        $sql_cnt .= " AND p.`status`=0 AND p.`invisible`=0";
    } elseif ($selState == 2) {#删除
        $sql .= " AND (p.`invisible`=-1 OR p.`status`=1)";
        $sql_cnt .= " AND (p.`invisible`=-1 OR p.`status`=1)";
    } elseif ($selState == 3) {#待审
        if ($selType == 2) {
            $sql .= " AND p.`invisible`<=-2 AND p.`first`=1";
            $sql_cnt .= " AND p.`invisible`<=-2 AND p.`first`=1";
        } elseif ($selType == 1) {
            $sql .= " AND p.`invisible`<=-2 AND p.`first`=0";
            $sql_cnt .= " AND p.`invisible`<=-2 AND p.`first`=0";
        } else {
            $sql .= " AND p.`invisible`<=-2";
            $sql_cnt .= " AND p.`invisible`<=-2";
            //$sql .= " AND ((p.`invisible`<=-2 AND p.`first`=0) OR (t.`displayorder`<=-2  AND p.`first`=1))";
            //$sql_cnt .= " AND ((p.`invisible`<=-2 AND p.`first`=0) OR (t.`displayorder`<=-2  AND p.`first`=1))";
        }
    }
    $url .= '&sel_state=' . $selState;
}
if ($selType) {
    $sql .= ' AND p.`first`=' . ($selType - 1);
    $sql_cnt .= ' AND p.`first`=' . ($selType - 1);
    $url .= '&sel_type=' . $selType;
}
if ($selDoer > 0) {
    if ($selDoer < 4) {
        $sql .= ' AND f.`isignore`=' . ($selDoer - 1);
        $sql_cnt .= ' AND f.`isignore`=' . ($selDoer - 1);
    }
    $url .= '&sel_doer=' . $selDoer;
}

//echo $sql;
#查询符合条件的总数
if ($Purify_FEEDBACK_PAGE) {
    $total = current($db->fetch_row($db->query($sql_cnt)));
    if ($total > 0) {
        $tpg = ceil($total / $pn);
        if ($pg > $tpg) {
            $pg = $tpg;
        }
    }
} else {
    $total = 0;
}

#有分页地查询出符合条件的帖子信息
if ($selFtime || $selTtime) {
    $sql .= ' ORDER BY p.`dateline` DESC';
} else {
    $sql .= ' ORDER BY f.`sendtime` DESC';
}

$from = $pn * ($pg - 1);
$sql .= ' LIMIT ' . $from . ',' . $pn;
$qy_res = $db->query($sql);

#查询出操作理由
$tipopts = modreasonselect(1);

#查询出版块
$sql = "SELECT `fid`, `name` FROM `{$tablepre}forums` WHERE 1 and type<>'group' and status=1";
$qy = $db->query($sql);
while ($row = $db->fetch_array($qy)) {
    $boards[$row['fid']] = $row;
}

#解析帖子内容
$HY_res = array();
while ($post = $db->fetch_array($qy_res)) {
    $post['theauthor'] = $post['author'];
    if ($post['authorid'] && $post['author']) {
        $post['author'] = "<a href=\"space.php?uid=$post[authorid]\" target=\"_blank\">$post[author]</a>";
    } elseif ($post['authorid'] && !$post['author']) {
        $post['author'] = "<a href=\"space.php?uid=$post[authorid]\" target=\"_blank\">$lang[anonymous]</a>";
    } else {
        $post['author'] = $lang['guest'];
    }
    $post['title'] = $post['subject'];
    $post['subject'] = $post['subject'] ? $post['subject'] : $lang['nosubject'];
    $post['messages'] = htmlspecialchars($post['message']);
    $post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], sprintf('%00b', $post['htmlon']), $post['allowsmilies'], $post['allowbbcode'], $post['allowimgcode'], $post['allowhtml']);
    if (floatval(DISCUZ_VERSION) >= 7.0)
        $post['modthreadkey'] = modthreadkey($post['tid']);

    if ($post['attachment']) {
        require_once HL_DISCUZ_ROOT . HL_DS . 'include' . HL_DS . 'attachment.func.php';

        $queryattach = $db->query("SELECT aid, filename, filetype, filesize, attachment, isimage, remote FROM {$tablepre}attachments WHERE pid='$post[pid]'");
        while ($attach = $db->fetch_array($queryattach)) {
            $attachurl = $attach['remote'] ? $ftp['attachurl'] : $attachurl;
            $attach['url'] = $attach['isimage'] ? " $attach[filename] (" . sizecount($attach['filesize']) . ")<br /><br /><img src=\"$attachurl/$attach[attachment]\" onload=\"if(this.width > 400) {this.resized=true; this.width=400;}\">" : "<a href=\"$attachurl/$attach[attachment]\" target=\"_blank\">$attach[filename]</a> (" . sizecount($attach['filesize']) . ")";
            $post['message'] .= "<br /><br />$lang[attachment]: " . attachtype(fileext($attach['filename']) . "\t" . $attach['filetype']) . $attach['url'];
        }
    }

    $post['text'] = htmlspecialchars($post['message']);
    $post['dateline'] = date('Y-m-d H:i:s', $post['dateline']);
    $post['sendtime'] = date('Y-m-d H:i:s', $post['sendtime']);
    if ('' != $post['sig'])
        $post['sig']++;
    else
        $post['sig'] = 0;

    #帖子当前状态
    if ($post['status'] == 0 && $post['invisible'] == 0)
        $post['isit'] = 1;#正常
    elseif ($post['invisible'] == -2 || $post['displayorder'] == -2)
        $post['isit'] = 2;#待审
    elseif ($post['invisible'] < 0 || $post['status'] == 1)
        $post['isit'] = 3;#已删除
    else
        $post['isit'] = 4;#未知的删除状态

    $HY_res[] = $post;
}

#分页处理
if ($total > 0) {
    $pger = new Pager;
    $pger->set_page($pn, 5, $url);
    $pger->set_style(12);
    $pager = $pger->print_page($total, $pg);
} else {
    if ($pg == 1) {
        $pager = "<b>首页</b>&nbsp;&nbsp;<a href='{$url}&page=" . ($pg + 1) . "'>下一页</a>";
    } elseif (!count($HY_res)) {
        $pager = "<a href='{$url}&page=" . ($pg - 1) . "'>上一页</a>&nbsp;&nbsp;<b>尾页</b>";
    } else {
        $pager = "<a href='{$url}&page=" . ($pg - 1) . "'>上一页</a>&nbsp;&nbsp;<a href='{$url}&page=" . ($pg + 1) . "'>下一页</a>";
    }
}



#解析到模板
if (floatval(DISCUZ_VERSION) >= 7.0) {
    include HL_PLUGIN_ROOT . HL_DS . 'template' . HL_DS . 'feedback7.tpl.php';
} else {
    include HL_PLUGIN_ROOT . HL_DS . 'template' . HL_DS . 'feedback6.tpl.php';
}





