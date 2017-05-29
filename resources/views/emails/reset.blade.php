<div style="text-align:center;">
    <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
        <tbody>
        <tr>
            <td>
                <p style="font-family: Helvetica Neue Light, Helvetica;text-align: left;font-weight: 300;font-size: 28px;color: #0079c1;"><strong style="margin: 0 6px;">{!! $user['name']!!}</strong>同学您好，为了保证您账号的安全以及方便您参加我们的考试，您必须完成邮箱的验证才能继续学习哦!</p>
                <a
                        href="{{route('reset-verification.check',$token . '?email=' . urlencode($user['email']) . '?student_num=' . $user['student_num'] )}}"
                        style="display:block;
                           margin:auto;
                           margin-top:40px;
                           border-radius:25px;
                           border:1px solid #2695f3;
                           padding:10px;
                           width:107px;
                           color:#2695f3;
                           font-weight:bold;
                           outline:none;
                           font-size:14px;
                           text-align:center;
                           text-decoration:none;"
                        target="_blank">
                    点我完成验证
                </a>
             </td>
        </tr>
        </tbody>
    </table>
</div>