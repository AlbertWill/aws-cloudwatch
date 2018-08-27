<?php
// This file was auto-generated from sdk-root/src/data/workspaces/2015-04-08/docs-2.json
return [ 'version' => '2.0', 'service' => '<fullname>Amazon WorkSpaces Service</fullname> <p>Amazon WorkSpaces enables you to provision virtual, cloud-based Microsoft Windows desktops for your users.</p>', 'operations' => [ 'AssociateIpGroups' => '<p>Associates the specified IP access control group with the specified directory.</p>', 'AuthorizeIpRules' => '<p>Adds one or more rules to the specified IP access control group.</p> <p>This action gives users permission to access their WorkSpaces from the CIDR address ranges specified in the rules.</p>', 'CreateIpGroup' => '<p>Creates an IP access control group.</p> <p>An IP access control group provides you with the ability to control the IP addresses from which users are allowed to access their WorkSpaces. To specify the CIDR address ranges, add rules to your IP access control group and then associate the group with your directory. You can add rules when you create the group or at any time using <a>AuthorizeIpRules</a>.</p> <p>There is a default IP access control group associated with your directory. If you don\'t associate an IP access control group with your directory, the default group is used. The default group includes a default rule that allows users to access their WorkSpaces from anywhere. You cannot modify the default IP access control group for your directory.</p>', 'CreateTags' => '<p>Creates the specified tags for the specified WorkSpace.</p>', 'CreateWorkspaces' => '<p>Creates one or more WorkSpaces.</p> <p>This operation is asynchronous and returns before the WorkSpaces are created.</p>', 'DeleteIpGroup' => '<p>Deletes the specified IP access control group.</p> <p>You cannot delete an IP access control group that is associated with a directory.</p>', 'DeleteTags' => '<p>Deletes the specified tags from the specified WorkSpace.</p>', 'DescribeIpGroups' => '<p>Describes one or more of your IP access control groups.</p>', 'DescribeTags' => '<p>Describes the specified tags for the specified WorkSpace.</p>', 'DescribeWorkspaceBundles' => '<p>Describes the available WorkSpace bundles.</p> <p>You can filter the results using either bundle ID or owner, but not both.</p>', 'DescribeWorkspaceDirectories' => '<p>Describes the available AWS Directory Service directories that are registered with Amazon WorkSpaces.</p>', 'DescribeWorkspaces' => '<p>Describes the specified WorkSpaces.</p> <p>You can filter the results using bundle ID, directory ID, or owner, but you can specify only one filter at a time.</p>', 'DescribeWorkspacesConnectionStatus' => '<p>Describes the connection status of the specified WorkSpaces.</p>', 'DisassociateIpGroups' => '<p>Disassociates the specified IP access control group from the specified directory.</p>', 'ModifyWorkspaceProperties' => '<p>Modifies the specified WorkSpace properties.</p>', 'ModifyWorkspaceState' => '<p>Sets the state of the specified WorkSpace.</p> <p>To maintain a WorkSpace without being interrupted, set the WorkSpace state to <code>ADMIN_MAINTENANCE</code>. WorkSpaces in this state do not respond to requests to reboot, stop, start, or rebuild. An AutoStop WorkSpace in this state is not stopped. Users can log into a WorkSpace in the <code>ADMIN_MAINTENANCE</code> state.</p>', 'RebootWorkspaces' => '<p>Reboots the specified WorkSpaces.</p> <p>You cannot reboot a WorkSpace unless its state is <code>AVAILABLE</code> or <code>UNHEALTHY</code>.</p> <p>This operation is asynchronous and returns before the WorkSpaces have rebooted.</p>', 'RebuildWorkspaces' => '<p>Rebuilds the specified WorkSpace.</p> <p>You cannot rebuild a WorkSpace unless its state is <code>AVAILABLE</code>, <code>ERROR</code>, or <code>UNHEALTHY</code>.</p> <p>Rebuilding a WorkSpace is a potentially destructive action that can result in the loss of data. For more information, see <a href="http://docs.aws.amazon.com/workspaces/latest/adminguide/reset-workspace.html">Rebuild a WorkSpace</a>.</p> <p>This operation is asynchronous and returns before the WorkSpaces have been completely rebuilt.</p>', 'RevokeIpRules' => '<p>Removes one or more rules from the specified IP access control group.</p>', 'StartWorkspaces' => '<p>Starts the specified WorkSpaces.</p> <p>You cannot start a WorkSpace unless it has a running mode of <code>AutoStop</code> and a state of <code>STOPPED</code>.</p>', 'StopWorkspaces' => '<p> Stops the specified WorkSpaces.</p> <p>You cannot stop a WorkSpace unless it has a running mode of <code>AutoStop</code> and a state of <code>AVAILABLE</code>, <code>IMPAIRED</code>, <code>UNHEALTHY</code>, or <code>ERROR</code>.</p>', 'TerminateWorkspaces' => '<p>Terminates the specified WorkSpaces.</p> <p>Terminating a WorkSpace is a permanent action and cannot be undone. The user\'s data is destroyed. If you need to archive any user data, contact Amazon Web Services before terminating the WorkSpace.</p> <p>You can terminate a WorkSpace that is in any state except <code>SUSPENDED</code>.</p> <p>This operation is asynchronous and returns before the WorkSpaces have been completely terminated.</p>', 'UpdateRulesOfIpGroup' => '<p>Replaces the current rules of the specified IP access control group with the specified rules.</p>', ], 'shapes' => [ 'ARN' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$IamRoleId' => '<p>The identifier of the IAM role. This is the role that allows Amazon WorkSpaces to make calls to other services, such as Amazon EC2, on your behalf.</p>', ], ], 'AccessDeniedException' => [ 'base' => '<p>The user is not authorized to access a resource.</p>', 'refs' => [], ], 'Alias' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$Alias' => '<p>The directory alias.</p>', ], ], 'AssociateIpGroupsRequest' => [ 'base' => NULL, 'refs' => [], ], 'AssociateIpGroupsResult' => [ 'base' => NULL, 'refs' => [], ], 'AuthorizeIpRulesRequest' => [ 'base' => NULL, 'refs' => [], ], 'AuthorizeIpRulesResult' => [ 'base' => NULL, 'refs' => [], ], 'BooleanObject' => [ 'base' => NULL, 'refs' => [ 'DefaultWorkspaceCreationProperties$EnableWorkDocs' => '<p>Indicates whether the directory is enabled for Amazon WorkDocs.</p>', 'DefaultWorkspaceCreationProperties$EnableInternetAccess' => '<p>The public IP address to attach to all WorkSpaces that are created or rebuilt.</p>', 'DefaultWorkspaceCreationProperties$UserEnabledAsLocalAdministrator' => '<p>Indicates whether the WorkSpace user is an administrator on the WorkSpace.</p>', 'Workspace$UserVolumeEncryptionEnabled' => '<p>Indicates whether the data stored on the user volume is encrypted.</p>', 'Workspace$RootVolumeEncryptionEnabled' => '<p>Indicates whether the data stored on the root volume is encrypted.</p>', 'WorkspaceRequest$UserVolumeEncryptionEnabled' => '<p>Indicates whether the data stored on the user volume is encrypted.</p>', 'WorkspaceRequest$RootVolumeEncryptionEnabled' => '<p>Indicates whether the data stored on the root volume is encrypted.</p>', ], ], 'BundleId' => [ 'base' => NULL, 'refs' => [ 'BundleIdList$member' => NULL, 'DescribeWorkspacesRequest$BundleId' => '<p>The ID of the bundle. All WorkSpaces that are created from this bundle are retrieved. This parameter cannot be combined with any other filter.</p>', 'Workspace$BundleId' => '<p>The identifier of the bundle used to create the WorkSpace.</p>', 'WorkspaceBundle$BundleId' => '<p>The bundle identifier.</p>', 'WorkspaceRequest$BundleId' => '<p>The identifier of the bundle for the WorkSpace. You can use <a>DescribeWorkspaceBundles</a> to list the available bundles.</p>', ], ], 'BundleIdList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspaceBundlesRequest$BundleIds' => '<p>The IDs of the bundles. This parameter cannot be combined with any other filter.</p>', ], ], 'BundleList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspaceBundlesResult$Bundles' => '<p>Information about the bundles.</p>', ], ], 'BundleOwner' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspaceBundlesRequest$Owner' => '<p>The owner of the bundles. This parameter cannot be combined with any other filter.</p> <p>Specify <code>AMAZON</code> to describe the bundles provided by AWS or null to describe the bundles that belong to your account.</p>', 'WorkspaceBundle$Owner' => '<p>The owner of the bundle. This is the account identifier of the owner, or <code>AMAZON</code> if the bundle is provided by AWS.</p>', ], ], 'Compute' => [ 'base' => NULL, 'refs' => [ 'ComputeType$Name' => '<p>The compute type.</p>', 'WorkspaceProperties$ComputeTypeName' => '<p>The compute type. For more information, see <a href="http://aws.amazon.com/workspaces/details/#Amazon_WorkSpaces_Bundles">Amazon WorkSpaces Bundles</a>.</p>', ], ], 'ComputeType' => [ 'base' => '<p>Information about the compute type.</p>', 'refs' => [ 'WorkspaceBundle$ComputeType' => '<p>The compute type. For more information, see <a href="http://aws.amazon.com/workspaces/details/#Amazon_WorkSpaces_Bundles">Amazon WorkSpaces Bundles</a>.</p>', ], ], 'ComputerName' => [ 'base' => NULL, 'refs' => [ 'Workspace$ComputerName' => '<p>The name of the WorkSpace, as seen by the operating system.</p>', ], ], 'ConnectionState' => [ 'base' => NULL, 'refs' => [ 'WorkspaceConnectionStatus$ConnectionState' => '<p>The connection state of the WorkSpace. The connection state is unknown if the WorkSpace is stopped.</p>', ], ], 'CreateIpGroupRequest' => [ 'base' => NULL, 'refs' => [], ], 'CreateIpGroupResult' => [ 'base' => NULL, 'refs' => [], ], 'CreateTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'CreateTagsResult' => [ 'base' => NULL, 'refs' => [], ], 'CreateWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'CreateWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'DefaultOu' => [ 'base' => NULL, 'refs' => [ 'DefaultWorkspaceCreationProperties$DefaultOu' => '<p>The organizational unit (OU) in the directory for the WorkSpace machine accounts.</p>', ], ], 'DefaultWorkspaceCreationProperties' => [ 'base' => '<p>Information about defaults used to create a WorkSpace.</p>', 'refs' => [ 'WorkspaceDirectory$WorkspaceCreationProperties' => '<p>The default creation properties for all WorkSpaces in the directory.</p>', ], ], 'DeleteIpGroupRequest' => [ 'base' => NULL, 'refs' => [], ], 'DeleteIpGroupResult' => [ 'base' => NULL, 'refs' => [], ], 'DeleteTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DeleteTagsResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeIpGroupsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeIpGroupsResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeTagsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeTagsResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspaceBundlesRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspaceBundlesResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspaceDirectoriesRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspaceDirectoriesResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspacesConnectionStatusRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspacesConnectionStatusResult' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'DescribeWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'Description' => [ 'base' => NULL, 'refs' => [ 'FailedCreateWorkspaceRequest$ErrorMessage' => '<p>The textual error message.</p>', 'FailedWorkspaceChangeRequest$ErrorMessage' => '<p>The textual error message.</p>', 'Workspace$ErrorMessage' => '<p>If the WorkSpace could not be created, contains a textual error message that describes the failure.</p>', 'WorkspaceBundle$Description' => '<p>A description.</p>', ], ], 'DirectoryId' => [ 'base' => NULL, 'refs' => [ 'AssociateIpGroupsRequest$DirectoryId' => '<p>The ID of the directory.</p>', 'DescribeWorkspacesRequest$DirectoryId' => '<p>The ID of the directory. In addition, you can optionally specify a specific directory user (see <code>UserName</code>). This parameter cannot be combined with any other filter.</p>', 'DirectoryIdList$member' => NULL, 'DisassociateIpGroupsRequest$DirectoryId' => '<p>The ID of the directory.</p>', 'Workspace$DirectoryId' => '<p>The identifier of the AWS Directory Service directory for the WorkSpace.</p>', 'WorkspaceDirectory$DirectoryId' => '<p>The directory identifier.</p>', 'WorkspaceRequest$DirectoryId' => '<p>The identifier of the AWS Directory Service directory for the WorkSpace. You can use <a>DescribeWorkspaceDirectories</a> to list the available directories.</p>', ], ], 'DirectoryIdList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspaceDirectoriesRequest$DirectoryIds' => '<p>The identifiers of the directories. If the value is null, all directories are retrieved.</p>', ], ], 'DirectoryList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspaceDirectoriesResult$Directories' => '<p>Information about the directories.</p>', ], ], 'DirectoryName' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$DirectoryName' => '<p>The name of the directory.</p>', ], ], 'DisassociateIpGroupsRequest' => [ 'base' => NULL, 'refs' => [], ], 'DisassociateIpGroupsResult' => [ 'base' => NULL, 'refs' => [], ], 'DnsIpAddresses' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$DnsIpAddresses' => '<p>The IP addresses of the DNS servers for the directory.</p>', ], ], 'ErrorType' => [ 'base' => NULL, 'refs' => [ 'FailedCreateWorkspaceRequest$ErrorCode' => '<p>The error code.</p>', 'FailedWorkspaceChangeRequest$ErrorCode' => '<p>The error code.</p>', ], ], 'ExceptionMessage' => [ 'base' => NULL, 'refs' => [ 'AccessDeniedException$message' => NULL, 'InvalidParameterValuesException$message' => '<p>The exception error message.</p>', 'InvalidResourceStateException$message' => NULL, 'OperationInProgressException$message' => NULL, 'OperationNotSupportedException$message' => NULL, 'ResourceAlreadyExistsException$message' => NULL, 'ResourceAssociatedException$message' => NULL, 'ResourceCreationFailedException$message' => NULL, 'ResourceLimitExceededException$message' => '<p>The exception error message.</p>', 'ResourceNotFoundException$message' => '<p>The resource could not be found.</p>', 'ResourceUnavailableException$message' => '<p>The exception error message.</p>', 'UnsupportedWorkspaceConfigurationException$message' => NULL, ], ], 'FailedCreateWorkspaceRequest' => [ 'base' => '<p>Information about a WorkSpace that could not be created.</p>', 'refs' => [ 'FailedCreateWorkspaceRequests$member' => NULL, ], ], 'FailedCreateWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'CreateWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpaces that could not be created.</p>', ], ], 'FailedRebootWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'RebootWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpaces that could not be rebooted.</p>', ], ], 'FailedRebuildWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'RebuildWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpace if it could not be rebuilt.</p>', ], ], 'FailedStartWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'StartWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpaces that could not be started.</p>', ], ], 'FailedStopWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'StopWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpaces that could not be stopped.</p>', ], ], 'FailedTerminateWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'TerminateWorkspacesResult$FailedRequests' => '<p>Information about the WorkSpaces that could not be terminated.</p>', ], ], 'FailedWorkspaceChangeRequest' => [ 'base' => '<p>Information about a WorkSpace that could not be rebooted (<a>RebootWorkspaces</a>), rebuilt (<a>RebuildWorkspaces</a>), terminated (<a>TerminateWorkspaces</a>), started (<a>StartWorkspaces</a>), or stopped (<a>StopWorkspaces</a>).</p>', 'refs' => [ 'FailedRebootWorkspaceRequests$member' => NULL, 'FailedRebuildWorkspaceRequests$member' => NULL, 'FailedStartWorkspaceRequests$member' => NULL, 'FailedStopWorkspaceRequests$member' => NULL, 'FailedTerminateWorkspaceRequests$member' => NULL, ], ], 'InvalidParameterValuesException' => [ 'base' => '<p>One or more parameter values are not valid.</p>', 'refs' => [], ], 'InvalidResourceStateException' => [ 'base' => '<p>The state of the resource is not valid for this operation.</p>', 'refs' => [], ], 'IpAddress' => [ 'base' => NULL, 'refs' => [ 'DnsIpAddresses$member' => NULL, 'Workspace$IpAddress' => '<p>The IP address of the WorkSpace.</p>', ], ], 'IpGroupDesc' => [ 'base' => NULL, 'refs' => [ 'CreateIpGroupRequest$GroupDesc' => '<p>The description of the group.</p>', 'WorkspacesIpGroup$groupDesc' => '<p>The description of the group.</p>', ], ], 'IpGroupId' => [ 'base' => NULL, 'refs' => [ 'AuthorizeIpRulesRequest$GroupId' => '<p>The ID of the group.</p>', 'CreateIpGroupResult$GroupId' => '<p>The ID of the group.</p>', 'DeleteIpGroupRequest$GroupId' => '<p>The ID of the IP access control group.</p>', 'IpGroupIdList$member' => NULL, 'RevokeIpRulesRequest$GroupId' => '<p>The ID of the group.</p>', 'UpdateRulesOfIpGroupRequest$GroupId' => '<p>The ID of the group.</p>', 'WorkspacesIpGroup$groupId' => '<p>The ID of the group.</p>', ], ], 'IpGroupIdList' => [ 'base' => NULL, 'refs' => [ 'AssociateIpGroupsRequest$GroupIds' => '<p>The IDs of one or more IP access control groups.</p>', 'DescribeIpGroupsRequest$GroupIds' => '<p>The IDs of one or more IP access control groups.</p>', 'DisassociateIpGroupsRequest$GroupIds' => '<p>The IDs of one or more IP access control groups.</p>', 'WorkspaceDirectory$ipGroupIds' => '<p>The identifiers of the IP access control groups associated with the directory.</p>', ], ], 'IpGroupName' => [ 'base' => NULL, 'refs' => [ 'CreateIpGroupRequest$GroupName' => '<p>The name of the group.</p>', 'WorkspacesIpGroup$groupName' => '<p>The name of the group.</p>', ], ], 'IpRevokedRuleList' => [ 'base' => NULL, 'refs' => [ 'RevokeIpRulesRequest$UserRules' => '<p>The rules to remove from the group.</p>', ], ], 'IpRule' => [ 'base' => NULL, 'refs' => [ 'IpRevokedRuleList$member' => NULL, 'IpRuleItem$ipRule' => '<p>The IP address range, in CIDR notation.</p>', ], ], 'IpRuleDesc' => [ 'base' => NULL, 'refs' => [ 'IpRuleItem$ruleDesc' => '<p>The description.</p>', ], ], 'IpRuleItem' => [ 'base' => '<p>Information about a rule for an IP access control group.</p>', 'refs' => [ 'IpRuleList$member' => NULL, ], ], 'IpRuleList' => [ 'base' => NULL, 'refs' => [ 'AuthorizeIpRulesRequest$UserRules' => '<p>The rules to add to the group.</p>', 'CreateIpGroupRequest$UserRules' => '<p>The rules to add to the group.</p>', 'UpdateRulesOfIpGroupRequest$UserRules' => '<p>One or more rules.</p>', 'WorkspacesIpGroup$userRules' => '<p>The rules.</p>', ], ], 'Limit' => [ 'base' => NULL, 'refs' => [ 'DescribeIpGroupsRequest$MaxResults' => '<p>The maximum number of items to return.</p>', 'DescribeWorkspacesRequest$Limit' => '<p>The maximum number of items to return.</p>', ], ], 'ModificationResourceEnum' => [ 'base' => NULL, 'refs' => [ 'ModificationState$Resource' => '<p>The resource.</p>', ], ], 'ModificationState' => [ 'base' => '<p>Information about a WorkSpace modification.</p>', 'refs' => [ 'ModificationStateList$member' => NULL, ], ], 'ModificationStateEnum' => [ 'base' => NULL, 'refs' => [ 'ModificationState$State' => '<p>The modification state.</p>', ], ], 'ModificationStateList' => [ 'base' => NULL, 'refs' => [ 'Workspace$ModificationStates' => '<p>The modification states of the WorkSpace.</p>', ], ], 'ModifyWorkspacePropertiesRequest' => [ 'base' => NULL, 'refs' => [], ], 'ModifyWorkspacePropertiesResult' => [ 'base' => NULL, 'refs' => [], ], 'ModifyWorkspaceStateRequest' => [ 'base' => NULL, 'refs' => [], ], 'ModifyWorkspaceStateResult' => [ 'base' => NULL, 'refs' => [], ], 'NonEmptyString' => [ 'base' => NULL, 'refs' => [ 'CreateTagsRequest$ResourceId' => '<p>The ID of the WorkSpace. To find this ID, use <a>DescribeWorkspaces</a>.</p>', 'DeleteTagsRequest$ResourceId' => '<p>The ID of the WorkSpace. To find this ID, use <a>DescribeWorkspaces</a>.</p>', 'DescribeTagsRequest$ResourceId' => '<p>The ID of the WorkSpace. To find this ID, use <a>DescribeWorkspaces</a>.</p>', 'ResourceNotFoundException$ResourceId' => '<p>The ID of the resource that could not be found.</p>', 'ResourceUnavailableException$ResourceId' => '<p>The identifier of the resource that is not available.</p>', 'RootStorage$Capacity' => '<p>The size of the root volume.</p>', 'TagKeyList$member' => NULL, 'UserStorage$Capacity' => '<p>The size of the user storage.</p>', 'WorkspaceBundle$Name' => '<p>The name of the bundle.</p>', ], ], 'OperationInProgressException' => [ 'base' => '<p>The properties of this WorkSpace are currently being modified. Try again in a moment.</p>', 'refs' => [], ], 'OperationNotSupportedException' => [ 'base' => '<p>This operation is not supported.</p>', 'refs' => [], ], 'PaginationToken' => [ 'base' => NULL, 'refs' => [ 'DescribeIpGroupsRequest$NextToken' => '<p>The token for the next set of results. (You received this token from a previous call.)</p>', 'DescribeIpGroupsResult$NextToken' => '<p>The token to use to retrieve the next set of results, or null if there are no more results available. This token is valid for one day and must be used within that time frame.</p>', 'DescribeWorkspaceBundlesRequest$NextToken' => '<p>The token for the next set of results. (You received this token from a previous call.)</p>', 'DescribeWorkspaceBundlesResult$NextToken' => '<p>The token to use to retrieve the next set of results, or null if there are no more results available. This token is valid for one day and must be used within that time frame.</p>', 'DescribeWorkspaceDirectoriesRequest$NextToken' => '<p>The token for the next set of results. (You received this token from a previous call.)</p>', 'DescribeWorkspaceDirectoriesResult$NextToken' => '<p>The token to use to retrieve the next set of results, or null if there are no more results available. This token is valid for one day and must be used within that time frame.</p>', 'DescribeWorkspacesConnectionStatusRequest$NextToken' => '<p>The token for the next set of results. (You received this token from a previous call.)</p>', 'DescribeWorkspacesConnectionStatusResult$NextToken' => '<p>The token to use to retrieve the next set of results, or null if there are no more results available.</p>', 'DescribeWorkspacesRequest$NextToken' => '<p>The token for the next set of results. (You received this token from a previous call.)</p>', 'DescribeWorkspacesResult$NextToken' => '<p>The token to use to retrieve the next set of results, or null if there are no more results available. This token is valid for one day and must be used within that time frame.</p>', ], ], 'RebootRequest' => [ 'base' => '<p>Information used to reboot a WorkSpace.</p>', 'refs' => [ 'RebootWorkspaceRequests$member' => NULL, ], ], 'RebootWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'RebootWorkspacesRequest$RebootWorkspaceRequests' => '<p>The WorkSpaces to reboot. You can specify up to 25 WorkSpaces.</p>', ], ], 'RebootWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'RebootWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'RebuildRequest' => [ 'base' => '<p>Information used to rebuild a WorkSpace.</p>', 'refs' => [ 'RebuildWorkspaceRequests$member' => NULL, ], ], 'RebuildWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'RebuildWorkspacesRequest$RebuildWorkspaceRequests' => '<p>The WorkSpace to rebuild. You can specify a single WorkSpace.</p>', ], ], 'RebuildWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'RebuildWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'RegistrationCode' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$RegistrationCode' => '<p>The registration code for the directory. This is the code that users enter in their Amazon WorkSpaces client application to connect to the directory.</p>', ], ], 'ResourceAlreadyExistsException' => [ 'base' => '<p>The specified resource already exists.</p>', 'refs' => [], ], 'ResourceAssociatedException' => [ 'base' => '<p>The resource is associated with a directory.</p>', 'refs' => [], ], 'ResourceCreationFailedException' => [ 'base' => '<p>The resource could not be created.</p>', 'refs' => [], ], 'ResourceLimitExceededException' => [ 'base' => '<p>Your resource limits have been exceeded.</p>', 'refs' => [], ], 'ResourceNotFoundException' => [ 'base' => '<p>The resource could not be found.</p>', 'refs' => [], ], 'ResourceUnavailableException' => [ 'base' => '<p>The specified resource is not available.</p>', 'refs' => [], ], 'RevokeIpRulesRequest' => [ 'base' => NULL, 'refs' => [], ], 'RevokeIpRulesResult' => [ 'base' => NULL, 'refs' => [], ], 'RootStorage' => [ 'base' => '<p>Information about the root volume for a WorkSpace bundle.</p>', 'refs' => [ 'WorkspaceBundle$RootStorage' => '<p>The size of the root volume.</p>', ], ], 'RootVolumeSizeGib' => [ 'base' => NULL, 'refs' => [ 'WorkspaceProperties$RootVolumeSizeGib' => '<p>The size of the root volume.</p>', ], ], 'RunningMode' => [ 'base' => NULL, 'refs' => [ 'WorkspaceProperties$RunningMode' => '<p>The running mode. For more information, see <a href="http://docs.aws.amazon.com/workspaces/latest/adminguide/running-mode.html">Manage the WorkSpace Running Mode</a>.</p>', ], ], 'RunningModeAutoStopTimeoutInMinutes' => [ 'base' => NULL, 'refs' => [ 'WorkspaceProperties$RunningModeAutoStopTimeoutInMinutes' => '<p>The time after a user logs off when WorkSpaces are automatically stopped. Configured in 60 minute intervals.</p>', ], ], 'SecurityGroupId' => [ 'base' => NULL, 'refs' => [ 'DefaultWorkspaceCreationProperties$CustomSecurityGroupId' => '<p>The identifier of any security groups to apply to WorkSpaces when they are created.</p>', 'WorkspaceDirectory$WorkspaceSecurityGroupId' => '<p>The identifier of the security group that is assigned to new WorkSpaces.</p>', ], ], 'StartRequest' => [ 'base' => '<p>Information used to start a WorkSpace.</p>', 'refs' => [ 'StartWorkspaceRequests$member' => NULL, ], ], 'StartWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'StartWorkspacesRequest$StartWorkspaceRequests' => '<p>The WorkSpaces to start. You can specify up to 25 WorkSpaces.</p>', ], ], 'StartWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'StartWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'StopRequest' => [ 'base' => '<p>Information used to stop a WorkSpace.</p>', 'refs' => [ 'StopWorkspaceRequests$member' => NULL, ], ], 'StopWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'StopWorkspacesRequest$StopWorkspaceRequests' => '<p>The WorkSpaces to stop. You can specify up to 25 WorkSpaces.</p>', ], ], 'StopWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'StopWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'SubnetId' => [ 'base' => NULL, 'refs' => [ 'SubnetIds$member' => NULL, 'Workspace$SubnetId' => '<p>The identifier of the subnet for the WorkSpace.</p>', ], ], 'SubnetIds' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$SubnetIds' => '<p>The identifiers of the subnets used with the directory.</p>', ], ], 'Tag' => [ 'base' => '<p>Information about a tag.</p>', 'refs' => [ 'TagList$member' => NULL, ], ], 'TagKey' => [ 'base' => NULL, 'refs' => [ 'Tag$Key' => '<p>The key of the tag.</p>', ], ], 'TagKeyList' => [ 'base' => NULL, 'refs' => [ 'DeleteTagsRequest$TagKeys' => '<p>The tag keys.</p>', ], ], 'TagList' => [ 'base' => NULL, 'refs' => [ 'CreateTagsRequest$Tags' => '<p>The tags. Each WorkSpace can have a maximum of 50 tags.</p>', 'DescribeTagsResult$TagList' => '<p>The tags.</p>', 'WorkspaceRequest$Tags' => '<p>The tags for the WorkSpace.</p>', ], ], 'TagValue' => [ 'base' => NULL, 'refs' => [ 'Tag$Value' => '<p>The value of the tag.</p>', ], ], 'TargetWorkspaceState' => [ 'base' => NULL, 'refs' => [ 'ModifyWorkspaceStateRequest$WorkspaceState' => '<p>The WorkSpace state.</p>', ], ], 'TerminateRequest' => [ 'base' => '<p>Information used to terminate a WorkSpace.</p>', 'refs' => [ 'TerminateWorkspaceRequests$member' => NULL, ], ], 'TerminateWorkspaceRequests' => [ 'base' => NULL, 'refs' => [ 'TerminateWorkspacesRequest$TerminateWorkspaceRequests' => '<p>The WorkSpaces to terminate. You can specify up to 25 WorkSpaces.</p>', ], ], 'TerminateWorkspacesRequest' => [ 'base' => NULL, 'refs' => [], ], 'TerminateWorkspacesResult' => [ 'base' => NULL, 'refs' => [], ], 'Timestamp' => [ 'base' => NULL, 'refs' => [ 'WorkspaceConnectionStatus$ConnectionStateCheckTimestamp' => '<p>The timestamp of the connection state check.</p>', 'WorkspaceConnectionStatus$LastKnownUserConnectionTimestamp' => '<p>The timestamp of the last known user connection.</p>', ], ], 'UnsupportedWorkspaceConfigurationException' => [ 'base' => '<p>The configuration of this WorkSpace is not supported for this operation. For more information, see the <a href="http://docs.aws.amazon.com/workspaces/latest/adminguide/">Amazon WorkSpaces Administration Guide</a>. </p>', 'refs' => [], ], 'UpdateRulesOfIpGroupRequest' => [ 'base' => NULL, 'refs' => [], ], 'UpdateRulesOfIpGroupResult' => [ 'base' => NULL, 'refs' => [], ], 'UserName' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspacesRequest$UserName' => '<p>The name of the directory user. You must specify this parameter with <code>DirectoryId</code>.</p>', 'Workspace$UserName' => '<p>The user for the WorkSpace.</p>', 'WorkspaceDirectory$CustomerUserName' => '<p>The user name for the service account.</p>', 'WorkspaceRequest$UserName' => '<p>The username of the user for the WorkSpace. This username must exist in the AWS Directory Service directory for the WorkSpace.</p>', ], ], 'UserStorage' => [ 'base' => '<p>Information about the user storage for a WorkSpace bundle.</p>', 'refs' => [ 'WorkspaceBundle$UserStorage' => '<p>The size of the user storage.</p>', ], ], 'UserVolumeSizeGib' => [ 'base' => NULL, 'refs' => [ 'WorkspaceProperties$UserVolumeSizeGib' => '<p>The size of the user storage.</p>', ], ], 'VolumeEncryptionKey' => [ 'base' => NULL, 'refs' => [ 'Workspace$VolumeEncryptionKey' => '<p>The KMS key used to encrypt data stored on your WorkSpace.</p>', 'WorkspaceRequest$VolumeEncryptionKey' => '<p>The KMS key used to encrypt data stored on your WorkSpace.</p>', ], ], 'Workspace' => [ 'base' => '<p>Information about a WorkSpace.</p>', 'refs' => [ 'WorkspaceList$member' => NULL, ], ], 'WorkspaceBundle' => [ 'base' => '<p>Information about a WorkSpace bundle.</p>', 'refs' => [ 'BundleList$member' => NULL, ], ], 'WorkspaceConnectionStatus' => [ 'base' => '<p>Describes the connection status of a WorkSpace.</p>', 'refs' => [ 'WorkspaceConnectionStatusList$member' => NULL, ], ], 'WorkspaceConnectionStatusList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspacesConnectionStatusResult$WorkspacesConnectionStatus' => '<p>Information about the connection status of the WorkSpace.</p>', ], ], 'WorkspaceDirectory' => [ 'base' => '<p>Information about an AWS Directory Service directory for use with Amazon WorkSpaces.</p>', 'refs' => [ 'DirectoryList$member' => NULL, ], ], 'WorkspaceDirectoryState' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$State' => '<p>The state of the directory\'s registration with Amazon WorkSpaces</p>', ], ], 'WorkspaceDirectoryType' => [ 'base' => NULL, 'refs' => [ 'WorkspaceDirectory$DirectoryType' => '<p>The directory type.</p>', ], ], 'WorkspaceErrorCode' => [ 'base' => NULL, 'refs' => [ 'Workspace$ErrorCode' => '<p>If the WorkSpace could not be created, contains the error code.</p>', ], ], 'WorkspaceId' => [ 'base' => NULL, 'refs' => [ 'FailedWorkspaceChangeRequest$WorkspaceId' => '<p>The identifier of the WorkSpace.</p>', 'ModifyWorkspacePropertiesRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'ModifyWorkspaceStateRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'RebootRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'RebuildRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'StartRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'StopRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'TerminateRequest$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'Workspace$WorkspaceId' => '<p>The identifier of the WorkSpace.</p>', 'WorkspaceConnectionStatus$WorkspaceId' => '<p>The ID of the WorkSpace.</p>', 'WorkspaceIdList$member' => NULL, ], ], 'WorkspaceIdList' => [ 'base' => NULL, 'refs' => [ 'DescribeWorkspacesConnectionStatusRequest$WorkspaceIds' => '<p>The identifiers of the WorkSpaces. You can specify up to 25 WorkSpaces.</p>', 'DescribeWorkspacesRequest$WorkspaceIds' => '<p>The IDs of the WorkSpaces. This parameter cannot be combined with any other filter.</p> <p>Because the <a>CreateWorkspaces</a> operation is asynchronous, the identifier it returns is not immediately available. If you immediately call <a>DescribeWorkspaces</a> with this identifier, no information is returned.</p>', ], ], 'WorkspaceList' => [ 'base' => NULL, 'refs' => [ 'CreateWorkspacesResult$PendingRequests' => '<p>Information about the WorkSpaces that were created.</p> <p>Because this operation is asynchronous, the identifier returned is not immediately available for use with other operations. For example, if you call <a>DescribeWorkspaces</a> before the WorkSpace is created, the information returned can be incomplete.</p>', 'DescribeWorkspacesResult$Workspaces' => '<p>Information about the WorkSpaces.</p> <p>Because <a>CreateWorkspaces</a> is an asynchronous operation, some of the returned information could be incomplete.</p>', ], ], 'WorkspaceProperties' => [ 'base' => '<p>Information about a WorkSpace.</p>', 'refs' => [ 'ModifyWorkspacePropertiesRequest$WorkspaceProperties' => '<p>The properties of the WorkSpace.</p>', 'Workspace$WorkspaceProperties' => '<p>The properties of the WorkSpace.</p>', 'WorkspaceRequest$WorkspaceProperties' => '<p>The WorkSpace properties.</p>', ], ], 'WorkspaceRequest' => [ 'base' => '<p>Information used to create a WorkSpace.</p>', 'refs' => [ 'FailedCreateWorkspaceRequest$WorkspaceRequest' => '<p>Information about the WorkSpace.</p>', 'WorkspaceRequestList$member' => NULL, ], ], 'WorkspaceRequestList' => [ 'base' => NULL, 'refs' => [ 'CreateWorkspacesRequest$Workspaces' => '<p>The WorkSpaces to create. You can specify up to 25 WorkSpaces.</p>', ], ], 'WorkspaceState' => [ 'base' => NULL, 'refs' => [ 'Workspace$State' => '<p>The operational state of the WorkSpace.</p>', ], ], 'WorkspacesIpGroup' => [ 'base' => '<p>Information about an IP access control group.</p>', 'refs' => [ 'WorkspacesIpGroupsList$member' => NULL, ], ], 'WorkspacesIpGroupsList' => [ 'base' => NULL, 'refs' => [ 'DescribeIpGroupsResult$Result' => '<p>Information about the IP access control groups.</p>', ], ], ],];